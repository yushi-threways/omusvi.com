<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("aichiadm/ticket")
 */
class TicketController extends AbstractController
{
    /**
     * @Route("/", name="admin_ticket_index", methods={"GET"})
     */
    public function index(TicketRepository $ticketRepository): Response
    {
        return $this->render('admin/ticket/index.html.twig', [
            'tickets' => $ticketRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_ticket_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('admin_ticket_index');
        }

        return $this->render('admin/ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ticket_show", methods={"GET"})
     */
    public function show(Ticket $ticket): Response
    {
        return $this->render('admin/ticket/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_ticket_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ticket $ticket): Response
    {
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_ticket_index', [
                'id' => $ticket->getId(),
            ]);
        }

        return $this->render('admin/ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_ticket_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ticket $ticket): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ticket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/ticket_index');
    }
}
