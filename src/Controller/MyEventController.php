<?php

namespace App\Controller;

use App\Entity\MyEvent;
use App\Entity\MyEventSchedule;
use App\Form\MyEventType;
use App\Repository\MyEventRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class MyEventController extends AbstractController
{
    /**
     * @Route("/", name="my_event_index", methods={"GET"})
     */
    public function index(MyEventRepository $myEventRepository, TagRepository $tagRepository): Response
    {

        $tag = null;
        if ($request->query->has('tag')) {
            $tag = $tagRepository->findOneBy(['name' => $request->query->get('tag')]);
        }

        return $this->render('my_event/index.html.twig', [
            'my_events' => $myEventRepository->findTagEvent($tag),
        ]);
    }

    /**
     * @Route("/{id}", name="my_event_show", methods={"GET"})
     */
    public function show(MyEvent $myEvent): Response
    {

        

        return $this->render('my_event/show.html.twig', [
            'my_event' => $myEvent,
        ]);
    }
}
