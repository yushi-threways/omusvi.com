<?php

namespace App\Controller;

use App\Entity\MyEventVenue;
use App\Form\Type\MyEventVenueType;
use App\Repository\MyEventVenueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/venue")
 */
class MyEventVenueController extends AbstractController
{
    /**
     * @Route("/", name="my_event_venue_index", methods={"GET"})
     */
    public function index(Request $request, MyEventVenueRepository $myEventVenueRepository, PaginatorInterface $paginator): Response
    {

        $query = $myEventVenueRepository->findAll();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        $pagination_data = $pagination->getPaginationData();

        return $this->render('my_event_venue/index.html.twig', [
            'pagination' => $pagination,
            'total' => $pagination->getTotalItemCount(),
            'start' => $pagination_data['firstItemNumber'],
            'end' => $pagination_data['lastItemNumber']
        ]);
    }
}
