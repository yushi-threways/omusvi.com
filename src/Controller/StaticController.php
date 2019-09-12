<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig_Error_Loader;

class StaticController extends AbstractController
{
    /**
     * @Route("/{page}", name="omipari_static", requirements={"page"="about|agree|aosct|qa|guide"})
     */
    public function index($page)
    {
        try {
            return $this->render("static/{$page}.html.twig", []);
        } catch (Twig_Error_Loader $e) {
            return $this->redirectToRoute('app_default_index');
        }
    }
}