<?php

namespace App\Controller\Admin;

use App\Entity\MyEventSchedule;
use App\Form\MyEventScheduleType;
use App\Repository\MyEventScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/my/event/schedule")
 */
class MyEventScheduleController extends AbstractController
{
    /**
     * @Route("/", name="admin_my_event_schedule_index", methods={"GET"})
     */
    public function index(MyEventScheduleRepository $myEventScheduleRepository): Response
    {
        return $this->render('my_event_schedule/index.html.twig', [
            'my_event_schedules' => $myEventScheduleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_my_event_schedule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myEventSchedule = new MyEventSchedule();
        $form = $this->createForm(MyEventScheduleType::class, $myEventSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myEventSchedule);
            $entityManager->flush();

            return $this->redirectToRoute('my_event_schedule_index');
        }

        return $this->render('my_event_schedule/new.html.twig', [
            'my_event_schedule' => $myEventSchedule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_my_event_schedule_show", methods={"GET"})
     */
    public function show(MyEventSchedule $myEventSchedule): Response
    {
        return $this->render('my_event_schedule/show.html.twig', [
            'my_event_schedule' => $myEventSchedule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_my_event_schedule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyEventSchedule $myEventSchedule): Response
    {
        $form = $this->createForm(MyEventScheduleType::class, $myEventSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_event_schedule_index');
        }

        return $this->render('my_event_schedule/edit.html.twig', [
            'my_event_schedule' => $myEventSchedule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_my_event_schedule_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MyEventSchedule $myEventSchedule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myEventSchedule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myEventSchedule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_event_schedule_index');
    }
}
