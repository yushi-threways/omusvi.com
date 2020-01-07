<?php

namespace App\Controller;

use App\Entity\MyEvent;
use App\Entity\MyEventSchedule;
use App\Entity\MyEventApplication;
use App\Form\Type\MyEventSearchType;
use App\Repository\MyEventRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DBAL\Types\GenderEnumType;

/**
 * @Route("/event/search")
 */
class MyEventSearchController extends AbstractController
{

    /**
     * @Route("/", name="my_event_search", methods={"GET"})
     */
    public function index(Request $request, MyEventRepository $myEventRepository, TagRepository $tagRepository): Response
    {

        $tag = null;
        if ($request->query->has('tag')) {
            $tag = $tagRepository->findOneBy(['name' => $request->query->get('tag')]);
        }

        return $this->render('search/index.html.twig', [
            'my_events' => $myEventRepository->findTagEvent($tag),
        ]);
    }
}
