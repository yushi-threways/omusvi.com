<?php

namespace App\Controller;

use App\Entity\MyEventFlow;
use App\Form\MyEventFlowType;
use App\Repository\MyEventFlowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/my/event/flow")
 */
class MyEventFlowController extends AbstractController
{
    /**
     * @Route("/", name="my_event_flow_index", methods={"GET"})
     */
    public function index(MyEventFlowRepository $myEventFlowRepository): Response
    {
        return $this->render('my_event_flow/index.html.twig', [
            'my_event_flows' => $myEventFlowRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="my_event_flow_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myEventFlow = new MyEventFlow();
        $form = $this->createForm(MyEventFlowType::class, $myEventFlow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myEventFlow);
            $entityManager->flush();

            return $this->redirectToRoute('my_event_flow_index');
        }

        return $this->render('my_event_flow/new.html.twig', [
            'my_event_flow' => $myEventFlow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_event_flow_show", methods={"GET"})
     */
    public function show(MyEventFlow $myEventFlow): Response
    {
        return $this->render('my_event_flow/show.html.twig', [
            'my_event_flow' => $myEventFlow,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="my_event_flow_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyEventFlow $myEventFlow): Response
    {
        $form = $this->createForm(MyEventFlowType::class, $myEventFlow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_event_flow_index');
        }

        return $this->render('my_event_flow/edit.html.twig', [
            'my_event_flow' => $myEventFlow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_event_flow_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MyEventFlow $myEventFlow): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myEventFlow->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myEventFlow);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_event_flow_index');
    }
}
