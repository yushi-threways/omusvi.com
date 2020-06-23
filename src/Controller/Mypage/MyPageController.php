<?php

namespace App\Controller\Mypage;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MyEventApplicationRepository;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\Entity\MyEventApplication;
use App\Service\Mailer\TwigSwiftMailer;
use App\Form\Type\PaiedFormType;
use App\Form\Type\CanceledFormType;

/**
 * @Route("/mypage")
 */
class MyPageController extends AbstractController
{
    /**
     * @Route("/")
     * @param MyEventApplicationRepository $myEventApplicationRepository
     */
    public function index(MyEventApplicationRepository $myEventApplicationRepository, Request $request)
    {

        /** @var User $user */
        $user = $this->getUser();
        
        $paiedForm = $this->createForm(PaiedFormType::class);
        $paiedForm->handleRequest($request);

        if ($paiedForm->isSubmitted()) {
            return $this->redirectToRoute('mypage_event_application_applied');
        }

        $canceledForm = $this->createForm(CanceledFormType::class);
        $canceledForm->handleRequest($request);

        if ($canceledForm->isSubmitted()) {
            return $this->redirectToRoute('mypage_event_application_canceled');
        }

        dump($myEventApplicationRepository->getAppliedEventQuery($user)->getQuery()->getResult());
        
        return $this->render('my_page/index.html.twig', [
            'user' => $user,
            'paiedForm' => $paiedForm->createView(),
            'canceledForm' => $canceledForm->createView(),
            // 'appliedEvents' => $appliedEvents,
            // 'acceptedEvents' => $myEventApplicationRepository->getAcceptedEventQuery($user)->getQuery()->getResult(),
            // 'pastedEvents' => $myEventApplicationRepository->getPastedEventQuery($user)->getQuery()->getResult(),
            'appliedEvents' => [],
            'acceptedEvents' => [],
            'pastedEvents' => [],
        ]);
    }

    /**
     * @param Request $request
     * @param MyEventApplication $application
     * @Route("/event/application/{id}/applied", name="mypage_event_application_applied", methods={"POST"})
     */
    public function eventApplied(Request $request, MyEventApplication $application, TwigSwiftMailer $mailer): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user == $application->getUser()) {
            $this->addFlash('warning', '入金報告ができません。お問い合わせから直接ご連絡お願いいたします。');
            return $this->redirectToRoute('app_mypage_mypage_index');
        }

        $application->setStatus(MyEventApplicationStatusEnumType::PAIED);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $mailer->sendMessage('_email/my_event_application/paied.txt.twig', [
            'data' => $application,
            'user' => $application->getUser(),
            'schedule' => $application->getMyEventSchedule(),
            'my_event' => $application->getMyEventSchedule()->getMyEvent(),
            'detail' => $application->getUser()->getUserDetail(),
        ]);

            $this->addFlash('success', '入金報告が送信されました。確認しておりますのでしばらくお待ちください。');
            return $this->redirectToRoute('app_mypage_mypage_index');
    }

    /**
     * @param Request $request
     * @param MyEventApplication $application
     * @Route("/event/application/{id}/canceled", name="mypage_event_application_canceled", methods={"POST"})
     */
    public function eventPaied(Request $request, MyEventApplication $application, TwigSwiftMailer $mailer): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user == $application->getUser()) {
            $this->addFlash('warning', 'キャンセルができません。お問い合わせから直接ご連絡お願いいたします。');
            return $this->redirectToRoute('app_mypage_mypage_index');
        }

        $application->setStatus(MyEventApplicationStatusEnumType::CANCELED);
        $application->setCancelled(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $mailer->sendMessage('_email/my_event_application/canceled.txt.twig', [
            'application' => $application,
            'user' => $application->getUser(),
            'schedule' => $application->getMyEventSchedule(),
            'my_event' => $application->getMyEventSchedule()->getMyEvent(),
            'detail' => $application->getUser()->getUserDetail(),
        ]);

            $this->addFlash('success', 'イベント参加のキャンセルが送信されました。メールを送信しましたのでご確認お願いいたします。');
            return $this->redirectToRoute('app_mypage_mypage_index');
    }
}
