<?php

namespace App\Controller\Admin;

use App\Entity\UserDetail;
use App\Form\UserDetailType;
use App\Repository\UserDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user/detail")
 */
class UserDetailController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_detail_index", methods={"GET"})
     */
    public function index(UserDetailRepository $userDetailRepository): Response
    {
        return $this->render('admin/user_detail/index.html.twig', [
            'user_details' => $userDetailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_user_detail_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userDetail = new UserDetail();
        $form = $this->createForm(UserDetailType::class, $userDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userDetail);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_detail_index');
        }

        return $this->render('admin/user_detail/new.html.twig', [
            'user_detail' => $userDetail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_detail_show", methods={"GET"})
     */
    public function show(UserDetail $userDetail): Response
    {
        return $this->render('admin/user_detail/show.html.twig', [
            'user_detail' => $userDetail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_user_detail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserDetail $userDetail): Response
    {
        $form = $this->createForm(UserDetailType::class, $userDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_detail_index');
        }

        return $this->render('admin/user_detail/edit.html.twig', [
            'user_detail' => $userDetail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_detail_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserDetail $userDetail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userDetail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userDetail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_detail_index');
    }
}
