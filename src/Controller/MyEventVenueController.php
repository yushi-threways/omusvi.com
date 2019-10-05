<?php

namespace App\Controller;

use App\Entity\MyEventVenue;
use App\Form\Type\MyEventVenueType;
use App\Repository\MyEventVenueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/venue")
 */
class MyEventVenueController extends AbstractController
{
    /**
     * @Route("/", name="my_event_venue_index", methods={"GET"})
     */
    public function index(MyEventVenueRepository $myEventVenueRepository): Response
    {
        return $this->render('my_event_venue/index.html.twig', [
            'my_event_venues' => $myEventVenueRepository->findAll(),
        ]);
    }
}
