<?php

namespace App\Controller\Admin;

use App\Entity\Accept;
use App\Form\AcceptType;
use App\Repository\AcceptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("aichiadm/accept")
 */
class AcceptController extends AbstractController
{
    /**
     * @Route("/", name="admin_accept_index", methods={"GET"})
     */
    public function index(AcceptRepository $acceptRepository): Response
    {
        return $this->render('accept/index.html.twig', [
            'accepts' => $acceptRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_accept_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accept = new Accept();
        $form = $this->createForm(AcceptType::class, $accept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accept);
            $entityManager->flush();

            return $this->redirectToRoute('admin_accept_index');
        }

        return $this->render('accept/new.html.twig', [
            'accept' => $accept,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_accept_show", methods={"GET"})
     */
    public function show(Accept $accept): Response
    {
        return $this->render('accept/show.html.twig', [
            'accept' => $accept,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_accept_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accept $accept): Response
    {
        $form = $this->createForm(AcceptType::class, $accept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_accept_index', [
                'id' => $accept->getId(),
            ]);
        }

        return $this->render('accept/edit.html.twig', [
            'accept' => $accept,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_accept_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Accept $accept): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accept->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accept);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_accept_index');
    }
}
