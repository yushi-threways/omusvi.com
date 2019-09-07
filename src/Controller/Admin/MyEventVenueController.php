<?php

namespace App\Controller\Admin;

use App\Entity\MyEventVenue;
use App\Form\MyEventVenueType;
use App\Repository\MyEventVenueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/my/event/venue")
 */
class MyEventVenueController extends AbstractController
{
    /**
     * @Route("/", name="admin_my_event_venue_index", methods={"GET"})
     */
    public function index(MyEventVenueRepository $myEventVenueRepository): Response
    {
        return $this->render('admin/my_event_venue/index.html.twig', [
            'my_event_venues' => $myEventVenueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_my_event_venue_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myEventVenue = new MyEventVenue();
        $form = $this->createForm(MyEventVenueType::class, $myEventVenue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myEventVenue);
            $entityManager->flush();

            return $this->redirectToRoute('admin_my_event_venue_index');
        }

        return $this->render('admin/my_event_venue/new.html.twig', [
            'my_event_venue' => $myEventVenue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_my_event_venue_show", methods={"GET"})
     */
    public function show(MyEventVenue $myEventVenue): Response
    {
        return $this->render('admin/my_event_venue/show.html.twig', [
            'my_event_venue' => $myEventVenue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_my_event_venue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyEventVenue $myEventVenue): Response
    {
        $form = $this->createForm(MyEventVenueType::class, $myEventVenue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_my_event_venue_index');
        }

        return $this->render('admin/my_event_venue/edit.html.twig', [
            'my_event_venue' => $myEventVenue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_my_event_venue_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MyEventVenue $myEventVenue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myEventVenue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myEventVenue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_my_event_venue_index');
    }
}
