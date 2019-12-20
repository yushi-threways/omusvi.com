<?php

namespace App\Controller\Admin;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Entity\UserDetail;
use App\Form\Type\MyEventApplicationType;
use App\Form\Type\ConfirmFormType;
use App\Repository\UserRepository;
use App\Repository\MyEventScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/{id}/list", name="admin_my_event_application_list", methods={"GET"})
     */
    public function show(MyEventSchedule $myEventSchedule, UserRepository $userRepository)
    {

      $applicateUser = $userRepository->findByApplicateUser($myEventSchedule);

      return $this->render('admin/my_event_application/list.html.twig', [
        'my_event_schedule' => $myEventSchedule,
        'applicate_user' => $applicateUser
      ]);
    }
}
