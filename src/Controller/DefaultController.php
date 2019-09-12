<?php
declare(strict_types=1);
namespace App\Controller;

use App\Entity\MyEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MyEventRepository;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */
    public function index(Request $request): Response
    {
        /** @var MyEventRepository $repo */
        $repo = $this->getDoctrine()->getRepository(MyEvent::class);
        $myEvents -> $repo->findAll();

        return $this->render('default/index.html.twig', [
            'myEvents' => $myEvents,
        ]);
    }
}
