<?php
declare(strict_types=1);
namespace App\Controller;

use App\Entity\MyEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MyEventRepository;
use App\Repository\TagRepository;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", defaults={"_format"="html"}, methods={"GET"}, name="default_index")
     */
    public function index(Request $request, string $_format, TagRepository $tags): Response
    {

        $tag = null;
        if ($request->query->has('tag')) {
            $tag = $tags->findOneBy(['name' => $request->query->get('tag')]);
        }

        /** @var MyEventRepository $repo */
        $repo = $this->getDoctrine()->getRepository(MyEvent::class);
        $myEvents = $repo->findTagEvent($tag);

        
        return $this->render('default/index.' . $_format . '.twig', [
            'myEvents' => $myEvents,
        ]);
    }
}
