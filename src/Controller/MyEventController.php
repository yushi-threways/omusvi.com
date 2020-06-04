<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\MyEvent;
use App\Entity\UserDetail;
use App\Entity\MyEventTicket;
use Symfony\Component\Form\Forms;
use App\DBAL\Types\GenderEnumType;
use App\Entity\MyEventApplication;
use App\Form\Type\ConfirmFormType;
use App\Repository\MyEventRepository;
use App\Service\Mailer\TwigSwiftMailer;
use App\Repository\UserDetailRepository;
use App\Form\Type\MyEventPaymentFormType;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\Type\MyEventApplicationMenType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\MyEventApplicationWomanType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\DBAL\Types\MyEventApplicationPayMentEnumType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/event")
 */
class MyEventController extends AbstractController
{
    const SESSION_KEY = 'op_my_event';

    /**
     * @Route("/", name="my_event_index", methods={"GET"})
     */
    public function index(Request $request, MyEventRepository $myEventRepository, PaginatorInterface $paginator): Response
    {

        $query = $myEventRepository->findBeforeEvent();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $pagination_data = $pagination->getPaginationData();

        return $this->render('my_event/index.html.twig', [
            'pagination' => $pagination,
            'total' => $pagination->getTotalItemCount(),
            'start' => $pagination_data['firstItemNumber'],
            'end' => $pagination_data['lastItemNumber']
        ]);
    }

    /**
     * @Route("/{id}", name="my_event_show", methods={"GET", "POST"})
     */
    public function show(Request $request, MyEvent $myEvent): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        /** @var UserDetailRepository $repo */
        $repo = $this->getDoctrine()->getRepository(UserDetail::class);
        $detail = $repo->findOneBy(['user' => $user]);
        
        if (!$detail == null) {
            $session = $request->getSession();
            $data = $session->get(self::SESSION_KEY);
            $data = new MyEventApplication();

            dump($data);

            // $form = $this->getGenderAppForm($user->getUserDetail()->getGender(), $data);
            $formFactoryBuilder = Forms::createFormFactoryBuilder();
            $formFactory = $formFactoryBuilder->getFormFactory();

            $form = $formFactory->createBuilder(FormType::class)
            ->setMethod('POST')
            ->add('save', SubmitType::class)
            ->getForm();

            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    if ($form->getData()->getPayMentType() == MyEventApplicationPayMentEnumType::LOCALPAYMENT) {
                        $form->getData()->setStatus(MyEventApplicationStatusEnumType::ACCEPTED);
                    }
                    $session->set(self::SESSION_KEY, $form->getData());
                    return $this->redirectToRoute('my_event_application_confirm', ['id' => $data->getMyEventSchedule()->getId()]);
                }
            }

            return $this->render('my_event/show.html.twig', [
                'my_event' => $myEvent,
                'user' => $user,
                'form' => $form->createView(),
             ]);
        } else {
            return $this->render('my_event/show.html.twig', [
                'my_event' => $myEvent,
                'user' => $user,
             ]);
        }
    }

    public function getGenderAppForm($gender, $data) 
    {
        if ($gender == GenderEnumType::MALE) {
            $form = $this->createForm(MyEventApplicationMenType::class, $data);
        } elseif ($gender == GenderEnumType::FEMALE) {
            $form = $this->createForm(MyEventApplicationWomanType::class, $data);
        }
        
        return $form;
    }

    /**
     * @Route("/{id}/tickets/{ticket_id}/guest_purchases/new", name="my_event_guest_purchases", methods={"GET", "POST"})
     * @ParamConverter("my_event_ticket", options={"id" = "ticket_id"})
     */
    public function guestPurchases()
    {
        
    }

    /**
     * @Route("/{id}/tickets/{myEventTicket}/purchases/new", name="my_event_purchases", methods={"GET", "POST"})
     */
    public function purchases(Request $request, MyEvent $myEvent, MyEventTicket $myEventTicket)
    {
       
        $form = $this->createForm(MyEventPaymentFormType::class);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                return $this->redirectToRoute('my_event_purchases_confirm', ['id' => $myEvent, 'myEventTicket' => $myEventTicket]);
            }
        }

        return $this->render('my_event/purchases/new.html.twig', [
            'my_event' => $myEvent,
            'my_event_ticket' => $myEventTicket,
            'form' => $form->createView()
         ]);
    }

    /**
     * @Route("/{id}/tickets/{myEventTicket}/purchases/confirm", name="my_event_purchases_confirm", methods={"POST"})
     */
    public function purchasesConfirm(Request $request, MyEvent $myEvent, MyEventTicket $myEventTicket)
    {
        $formData = $request->request->get('my_event_payment_form');
        $paymentData = $formData['paymentType'];

        $session = $request->getSession();
        $session->set(self::SESSION_KEY, $paymentData);

        $form = $this->createForm(ConfirmFormType::class);

        return $this->render('my_event/purchases/confirm.html.twig', [
            'my_event' => $myEvent,
            'my_event_ticket' => $myEventTicket,
            'paymentData' => $paymentData,
            'form' => $form->createView()
         ]);
    }

    /**
     * @Route("/{id}/tickets/{myEventTicket}/purchases/complete", name="my_event_purchases_complete", methods={"POST"})
     */
    public function purchasesComplete(Request $request, MyEvent $myEvent, MyEventTicket $myEventTicket, TwigSwiftMailer $mailer)
    {

        $session = $request->getSession();
        $paymentData = $session->get(self::SESSION_KEY);

        $form = $this->createForm(ConfirmFormType::class)->handleRequest($request);

        // 申し込み済みの場合を追加、イベント日を過ぎていないを追加
        if ($form->isSubmitted() && $form->isValid()){
            $application = new MyEventApplication();
            /** @var User $user */
            $user = $this->getUser();
            $application->setUser($user);
            $application->setMyEventTicket($myEventTicket);
            $application->setPaymentType($paymentData);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();

//            $session->remove(self::SESSION_KEY);

//            if ($paymentData == 'bt') {
//                $mailer->sendMessage('_email/my_event_application/applied.txt.twig', [
//                    'data' => $application,
//                    'user' => $application->getUser(),
//                    'ticket' => $myEventTicket,
//                    'my_event' => $myEvent,
//                    'detail' => $application->getUser()->getUserDetail(),
//                ]);
//            } else {
//                $mailer->sendMessage('_email/my_event_application/accepted.txt.twig', [
//                    'data' => $application,
//                    'user' => $application->getUser(),
//                    'ticket' => $myEventTicket,
//                    'my_event' => $myEvent,
//                    'detail' => $application->getUser()->getUserDetail(),
//                ]);
//            }

            return $this->render('my_event/purchases/complete.html.twig', [
                'my_event' => $myEvent,
                'my_event_ticket' => $myEventTicket,
            ]);
        }

        return $this->redirectToRoute('my_event_show', ['id' => $myEvent->getId()]);
    }
}

