<?php

namespace App\Controller\Admin;

use App\Entity\MyEvent;
use App\Entity\MyEventFlow;
use App\Entity\MyEventSchedule;
use App\Form\Type\MyEventType;
use App\Repository\MyEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MyEventVenue;

/**
 * @Route("admin/my/event")
 */
class MyEventController extends AbstractController
{
    /**
     * @Route("/", name="admin_my_event_index", methods={"GET"})
     */
    public function index(MyEventRepository $myEventRepository, Request $request): Response
    {

        $sort = $request->query->get('sort');
        if (!$sort) {
            $sort = 'newest';
        }

        if ('before' === $sort) {
            $my_events = $myEventRepository->findBeforeEvent();
        } elseif ('after' === $sort) {
            $my_events = $myEventRepository->findAfterEvent();
        } else {
            $my_events = $myEventRepository->findAll();
        }

        return $this->render('admin/my_event/index.html.twig', [
            'my_events' => $my_events,
        ]);
    }

    /**
     * @Route("/new", name="admin_my_event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myEvent = new MyEvent();
        $flows = new MyEventFlow();
        $schedule = new MyEventSchedule();
        $schedule->setMyEvent($myEvent);
        $myEvent->addMyEventFlow($flows);

        $form = $this->createForm(MyEventType::class, $myEvent);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myEvent);
            $entityManager->flush();

            // $this->addFlash('success', 'イベントを登録しました');

            return $this->redirectToRoute('admin_my_event_index');
        }

        return $this->render('admin/my_event/new.html.twig', [
            'my_event' => $myEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_my_event_show", methods={"GET"})
     */
    public function show(MyEvent $myEvent): Response
    {
        return $this->render('admin/my_event/show.html.twig', [
            'my_event' => $myEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_my_event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyEvent $myEvent): Response
    {
        $form = $this->createForm(MyEventType::class, $myEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_my_event_index');
        }

        return $this->render('admin/my_event/edit.html.twig', [
            'my_event' => $myEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_my_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MyEvent $myEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_my_event_index');
    }
}
