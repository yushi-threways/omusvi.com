<?php

namespace App\Controller;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Form\MyEventApplicationType;
use App\Repository\MyEventApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event/schedule/{id}")
 */
class MyEventApplicationController extends AbstractController
{
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
     * @param MyEventSchedule $schedule
     * 
     * @Route("/confirm", name="my_event_application_confirm")
     */
    public function confirm(MyEventSchedule $schedule): Response
    {

        /** @var User $user */
        $user = $this->getUser();

        if (!$schedule->isApplied($user)) {
            return $this->render('front/job_application/confirm.html.twig', [
                'schedule' => $schedule,
                'form' => $this->createForm(ConfirmFormType::class)->createView(),
            ]);
        }
        
        $myEventApplication = new MyEventApplication();
        $form = $this->createForm(MyEventApplicationType::class, $myEventApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myEventApplication);
            $entityManager->flush();

            return $this->redirectToRoute('my_event_application_index');
        }

        return $this->render('my_event_application/new.html.twig', [
            'my_event_application' => $myEventApplication,
            'form' => $form->createView(),
        ]);
    }
}
