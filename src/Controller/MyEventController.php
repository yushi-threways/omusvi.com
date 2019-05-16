<?php

namespace App\Controller;

use App\Entity\MyEvent;
use App\Form\MyEvent1Type;
use App\Repository\MyEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class MyEventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(MyEventRepository $myEventRepository): Response
    {
        return $this->render('my_event/index.html.twig', [
            'my_events' => $myEventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myEvent = new MyEvent();
        $form = $this->createForm(MyEvent1Type::class, $myEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myEvent);
            $entityManager->flush();

            return $this->redirectToRoute('my_event_index');
        }

        return $this->render('my_event/new.html.twig', [
            'my_event' => $myEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(MyEvent $myEvent): Response
    {
        return $this->render('my_event/show.html.twig', [
            'my_event' => $myEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyEvent $myEvent): Response
    {
        $form = $this->createForm(MyEvent1Type::class, $myEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index', [
                'id' => $myEvent->getId(),
            ]);
        }

        return $this->render('my_event/edit.html.twig', [
            'my_event' => $myEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MyEvent $myEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
