<?php

namespace App\Controller\Mypage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mypage")
 */
class MyPageController extends AbstractController 
{
    /**
     * @Route("/")
     */
    public function index() {

        /** @var User $user */
        $user = $this->getUser();
        $detail = $user->getUserDetail();
        if (empty($detail)) {

            $this->addFlash('warning', '詳細情報の登録してください。');
            return $this->redirectToRoute('mypage_detail_edit');
        }

        return $this->render('my_page/index.html.twig', [
            $user = 'user',
        ]); 
    }
}