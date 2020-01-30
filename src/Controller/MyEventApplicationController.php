<?php

namespace App\Controller;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Entity\User;
use App\Entity\UserDetail;
use App\Form\Type\MyEventApplicationType;
use App\Form\Type\ConfirmFormType;
use App\Repository\MyEventApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\UserBundle\Model\UserInterface;
use App\Service\Mailer\TwigSwiftMailer;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\DBAL\Types\MyEventApplicationPayMentEnumType;


/**
 * @Route("/event/schedule/{id}")
 */
class MyEventApplicationController extends AbstractController
{
    const SESSION_KEY = 'op_my_event';

    /**
     * @param MyEventSchedule $schedule
     * @Route("/", name="my_event_application_index", methods={"GET"})
     */
    public function index(MyEventSchedule $schedule): Response
    {
        return $this->render('my_event_application/index.html.twig', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * @param Request $request
     * @param MyEventSchedule $schedule
     * @Route("/confirm", name="my_event_application_confirm")
     */
    public function confirm(Request $request, MyEventSchedule $schedule, TwigSwiftMailer $mailer): Response
    {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);

        if (!$data) {
            return $this->redirectToRoute('my_event_show', ['id' => $schedule->getMyEvent()->getId()]);
        }

        $user = $this->getUser();

        $form = $this->createForm(ConfirmFormType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $data->setUser($user);
            $data->setMyEventSchedule($schedule);
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();
            
            if ($data->getPayMentType() == MyEventApplicationPayMentEnumType::BANKTRANSFER) {
                $mailer->sendMessage('_email/my_event_application/applied.txt.twig', [
                    'data' => $data,
                    'user' => $data->getUser(),
                    'schedule' => $data->getMyEventSchedule(),
                    'my_event' => $data->getMyEventSchedule()->getMyEvent(),
                    'detail' => $data->getUser()->getUserDetail(),
                ]);
            } elseif ($data->getPayMentType() == MyEventApplicationPayMentEnumType::LOCALPAYMENT) {
                $mailer->sendMessage('_email/my_event_application/local_payment.txt.twig', [
                    'data' => $data,
                    'user' => $data->getUser(),
                    'schedule' => $data->getMyEventSchedule(),
                    'my_event' => $data->getMyEventSchedule()->getMyEvent(),
                    'detail' => $data->getUser()->getUserDetail(),
                ]);
            }
            

            $session->set(self::SESSION_KEY, $form->getData());
            return $this->redirectToRoute('my_event_application_complete', ['id' => $schedule->getId()]);
        }

        return $this->render('my_event_application/confirm.html.twig', [
            'form' => $form->createView(),
            'schedule' => $schedule,
            'data' => $data,
            'detail' => $user->getUserDetail(),
         ]);
    }

    /**
     * @param Request $request
     * @param MyEventSchedule $schedule
     * @param TwigSwiftMailer $mailer
     *
     * @Route("/complete", name="my_event_application_complete")
     */
    public function complete(Request $request, MyEventSchedule $schedule)
    {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);

        if (!$data) {
            return $this->redirectToRoute('my_event_show', ['id' => $schedule->getId()]);
        }

        $session->remove(self::SESSION_KEY);
        return $this->render('my_event_application/complete.html.twig', [
            'schedule' => $schedule
        ]);
    }
}
