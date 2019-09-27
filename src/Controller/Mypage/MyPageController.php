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

        return $this->render('my_page/index.html.twig', [
        ]); 
    }
}