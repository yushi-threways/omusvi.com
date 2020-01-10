<?php

namespace App\Controller;

use App\Entity\MyEvent;
use App\Entity\MyEventSchedule;
use App\Entity\MyEventApplication;
use App\Form\Type\MyEventSearchType;
use App\Repository\MyEventScheduleRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DBAL\Types\GenderEnumType;
use App\Model\SearchFilter\EventSearchFilter;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/search")
 */
class MyEventSearchController extends AbstractController
{

    /**
     * @Route("/", name="my_event_search")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $searchFilter = new EventSearchFilter();
        $form = $this->createForm(MyEventSearchType::class, $searchFilter);
        $form->handleRequest($request);
        
        /** @var MyEventScheduleRepository $repo */
        $repo = $this->getDoctrine()->getRepository(MyEventSchedule::class);
    

        $qb = $form->isSubmitted() && $form->isValid()?
            $repo->createQueryBuilderBySearchFilter($searchFilter):
            $repo->createQueryBuilder("myEvent");

        $pagination = $paginator->paginate(
            $qb, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $pagination_data = $pagination->getPaginationData();



        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
            'total' => $pagination->getTotalItemCount(),
            'start' => $pagination_data['firstItemNumber'],
            'end' => $pagination_data['lastItemNumber']
        ]);
    }
}
