<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\MyEvent;
use App\Entity\MyEventTicket;
use Symfony\Component\Form\Forms;
use App\Form\Type\ConfirmFormType;
use App\Repository\MyEventRepository;
use App\Service\Mailer\TwigSwiftMailer;
use App\Form\Type\MyEventPaymentFormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\MyEventApplication\Factory\UserMyEventApplicationFactory;

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

        return $this->render('my_event/index.html.twig', [
            'pagination' => $pagination,
            'total' => $pagination->getTotalItemCount(),
            'start' => $this->calcStart($pagination),
            'end' => $this->calcEnd($pagination)
        ]);
    }

    /**
     * @Route("/{id}", name="my_event_show", methods={"GET", "POST"})
     */
    public function show(Request $request, MyEvent $myEvent): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $formFactoryBuilder = Forms::createFormFactoryBuilder();
        $formFactory = $formFactoryBuilder->getFormFactory();
        $form = $formFactory->createBuilder(FormType::class)
            ->setMethod('POST')
            ->add('save', SubmitType::class)
            ->getForm();

        return $this->render('my_event/show.html.twig', [
            'my_event' => $myEvent,
            'user' => $user,
            'form' => $form->createView(),
        ]);
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

        \Stripe\Stripe::setApiKey('sk_test_51GrddrLMZDJdSAX608ugtvN4qIt47s7zYipkIYGV6lEwSLSTcVVVhttFyZI0v5a4tN0i02jLJ8sRV15PrfHXeTcy00RAcJ0ftT');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $myEventTicket->getPrice(),
            'currency' => 'jpy',
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);

        $form = $this->createForm(ConfirmFormType::class);

        return $this->render('my_event/purchases/confirm.html.twig', [
            'my_event' => $myEvent,
            'my_event_ticket' => $myEventTicket,
            'paymentData' => $paymentData,
            'form' => $form->createView(),
            'intent' => $intent
        ]);
    }

    /**
     * @Route("/{id}/tickets/{myEventTicket}/purchases/complete", name="my_event_purchases_complete", methods={"POST"})
     */
    public function purchasesComplete(Request $request, MyEvent $myEvent, MyEventTicket $myEventTicket, TwigSwiftMailer $mailer, UserMyEventApplicationFactory $userMyEventApplicationFactory)
    {

        $session = $request->getSession();
        $paymentData = $session->get(self::SESSION_KEY);

        $form = $this->createForm(ConfirmFormType::class)->handleRequest($request);
        /** User $user */
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid() && $myEventTicket->canApply($user)) {

            $application = $userMyEventApplicationFactory->userApplicationCreate($user, $myEventTicket, $paymentData);
            $session->remove(self::SESSION_KEY);

            if ($paymentData == 'bt') {
                $mailer->sendMessage('_email/my_event_application/applied.txt.twig', [
                    'data' => $application,
                    'user' => $user,
                    'ticket' => $myEventTicket,
                    'my_event' => $myEvent,
                    'detail' => $user->getUserDetail(),
                ]);
            } else {
                $mailer->sendMessage('_email/my_event_application/accepted.txt.twig', [
                    'data' => $application,
                    'user' => $user,
                    'ticket' => $myEventTicket,
                    'my_event' => $myEvent,
                    'detail' => $user->getUserDetail(),
                ]);
            }

            return $this->render('my_event/purchases/complete.html.twig', [
                'my_event' => $myEvent,
                'my_event_ticket' => $myEventTicket,
            ]);
        }

        $this->addFlash('warning', '申込済みのイベントです');
        return $this->redirectToRoute('my_event_show', ['id' => $myEvent->getId()]);
    }

    public function calcStart(PaginationInterface $pagination): int
    {
        $total = $pagination->getTotalItemCount();
        $start = ($pagination->getCurrentPageNumber() - 1) * $pagination->getItemNumberPerPage() + 1;
        return $start > $total? $total: $start;
    }
    
    public function calcEnd(PaginationInterface $pagination): int
    {
        $total = $pagination->getTotalItemCount();
        $end = $pagination->getCurrentPageNumber() * $pagination->getItemNumberPerPage();
        return $end > $total? $total: $end;
    }
}
