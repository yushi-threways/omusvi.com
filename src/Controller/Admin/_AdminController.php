<?php
declare(strict_types=1);
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MyEventRepository;

/**
 * Class AdminController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class _AdminController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/", name="admin_index")
     */
    public function index(MyEventRepository $myEventRepository): Response
    {
        $latesEEvents = $myEventRepository->findLatestEvent(3);
        
        return $this->render("admin/index.html.twig", [
            'latestEvents' => $latesEEvents,
        ]);
    }
}
