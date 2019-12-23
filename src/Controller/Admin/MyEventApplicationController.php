<?php

namespace App\Controller\Admin;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Form\Type\AcceptedFormType;
use App\Repository\MyEventScheduleRepository;
use App\Repository\MyEventApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\Service\Mailer\TwigSwiftMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/event/application")
 */
class MyEventApplicationController extends AbstractController
{
    /**
     * @Route("/", name="admin_my_event_application", methods={"GET"})
     */
    public function index(MyEventScheduleRepository $myEventScheduleRepository)
    {
      $schedules = $myEventScheduleRepository->findAll();

      return $this->render('admin/my_event_application/index.html.twig', [
        'my_event_schedules' => $schedules,
      ]);
    }

    /**
     * @param MyEventSchedule $myEventSchedule
     * @Route("/{id}/list", name="admin_my_event_application_list", methods={"GET", "POST"})
     */
    public function list(Request $request, MyEventSchedule $myEventSchedule, MyEventApplicationRepository $myEventApplicationRepository)
    {

      $applicateUser = $myEventApplicationRepository->findByApplicateUser($myEventSchedule);

      $acceptForm = $this->createForm(AcceptedFormType::class);
      $acceptForm->handleRequest($request);

      if ($acceptForm->isSubmitted()) {
          return $this->redirectToRoute('admin_my_event_application_accept');
      }

      return $this->render('admin/my_event_application/list.html.twig', [
        'my_event_schedule' => $myEventSchedule,
        'applicate_users' => $applicateUser,
        'form' => $acceptForm->createView()
      ]);
    }

    /**
     * @param MyEventApplication $application
     * @Route("/{id}/accept", name="admin_my_event_application_accept", methods={"POST"})
     */
    public function admin_accepted(Request $request, MyEventApplication $application, TwigSwiftMailer $mailer): Response
    {
       
        $application->setStatus(MyEventApplicationStatusEnumType::ACCEPTED);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $mailer->sendMessage('_email/my_event_application/accepted.txt.twig', [
            'data' => $application,
        ]);

            $this->addFlash('success', 'イベント支払い確認が行われました。。メールを送信しましたのでご確認お願いいたします。');
            return $this->redirectToRoute('admin_my_event_application_list', ['id' => $application->getMyEventSchedule()->getId()]);
    }
}
