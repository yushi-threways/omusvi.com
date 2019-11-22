<?php

namespace App\Controller\Admin;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Entity\UserDetail;
use App\Form\Type\MyEventApplicationType;
use App\Form\Type\ConfirmFormType;
use App\Repository\MyEventApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event/applicatoin")
 */
class MyEventApplicationController extends AbstractController
{
    /**
     * @Route("/", name="admin_my_event_application", methods={"GET"})
     */
   public function index()
   {

   }
}
