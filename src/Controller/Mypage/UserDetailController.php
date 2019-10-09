<?php

namespace App\Controller\Mypage;

use App\Entity\UserDetail;
use App\Entity\User;
use App\Form\Type\UserDetailType;
use App\DBAL\Types\GenderEnumType;
use App\Repository\UserDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mypage/detail")
 */
class UserDetailController extends AbstractController
{
    /**
     * @Route("/", name="mypage_detail_index", methods={"GET"})
     */
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $detail = $user->getUserDetail();

        return $this->render('my_page/user_detail/index.html.twig', [
            'detail' => $detail,
        ]);
    }

    /**
     * @Route("/edit", name="mypage_detail_edit")
     */
    public function edit(Request $request): Response
    {
        /** @var UserDetailRepository $repo */
        $repo = $this->getDoctrine()->getRepository(UserDetail::class);
        $detail = $repo->findOrCreateByUser($this->getUser());

        $form = $this->createForm(UserDetailType::class, $detail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detail);
            $entityManager->flush();
            
            $this->addFlash('success', 'ユーザー情報を更新しました。');

            return $this->redirectToRoute('mypage_detail_index');
        }

        return $this->render('my_page/user_detail/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/event", name="mypage_detail_event", methods={"GET"})
     */
    public function event(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('my_page/user_detail/event.html.twig', [

        ]);
    }
}
