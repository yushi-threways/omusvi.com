<?php

namespace App\Controller\Mypage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MyEventApplicationRepository;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\Entity\MyEventApplication;

/**
 * @Route("/mypage")
 */
class MyPageController extends AbstractController
{
    /**
     * @Route("/")
     * @param MyEventApplicationRepository $myEventApplicationRepository
     */
    public function index(MyEventApplicationRepository $myEventApplicationRepository)
    {

        /** @var User $user */
        $user = $this->getUser();
        $detail = $user->getUserDetail();
        if (empty($detail)) {
            $this->addFlash('warning', '詳細情報の登録してください。');
            return $this->redirectToRoute('mypage_detail_edit');
        }

        return $this->render('my_page/index.html.twig', [
            'user' => $user,
            'appliedEvents' => $myEventApplicationRepository->getAppliedEventQuery($user)->setMaxResults(5)->getQuery()->getResult(),
        ]);
    }

    /**
    * @Route("/event", name="mypage_event", methods={"GET"})
    */
    public function event(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('my_page/event.html.twig', [

        ]);
    }

    /**
     * @param Request $request
     * @param MyEventApplication $application
     * @Route("/event/application/{id}/applied", name="mypage_event_application_applied", methods={"POST"})
     */
    public function eventApplied(Request $request, MyEventApplication $application): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user == $application->getUser()) {
            $this->addFlash('warning', '入金報告ができません。お問い合わせから直接ご連絡お願いいたします。');
            return $this->redirectToRoute('app_mypage_mypage_index');
        }

        $application->serStatus(MyEventApplicationStatusEnumType::PAIED);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($application);
        $entityManager->flush();
    }
}
