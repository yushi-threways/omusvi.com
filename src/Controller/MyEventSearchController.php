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
use App\Repository\Criteria\MyEventCriteria;


/**
 * @Route("/search")
 */
class MyEventSearchController extends AbstractController
{
    const SESSION_KEY = 'event_search';

    /**
     * @Route("/", name="my_event_search")
     */
    public function index(Request $request, PaginatorInterface $paginator, TagRepository $tags): Response
    {
        
        $searchFilter = new EventSearchFilter();
        
        /** @var MyEventScheduleRepository $repo */
        $repo = $this->getDoctrine()->getRepository(MyEventSchedule::class);

        $form = $this->createForm(MyEventSearchType::class, $searchFilter);
        $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $qb = $repo->createQueryBuilderBySearchFilter($searchFilter);
            } else {
                if ($request->query->has('tag') || $request->query->has('startDate') || $request->query->has('endDate') || $request->query->has('startTime')) {
                    $tag = null;
                    $startDate = null;
                    $endDate = null;
                    $startTime = null;
                    if ($request->query->has('tag')) {
                        $tag = $tags->findOneBy(['name' => $request->query->get('tag')]);
                    } elseif ($request->query->has('startDate') && $request->query->has('endDate')) {
                        $startDate = new \DateTimeImmutable($request->query->get('startDate')['date']);
                        $endDate = new \DateTimeImmutable($request->query->get('endDate')['date']);
                        $startTime = new \DateTimeImmutable($request->query->get('startTime'));
                        $startDate = $startDate->setTime(0, 0);
                        $endDate = $endDate->setTime(23, 59);
                    }
                    $qb = $repo->createQueryBuilderBySearchRequest($tag, $startDate, $endDate, $startTime);

                } elseif($request->query->has('my_event_search')) {
                    $date = $request->query->get('my_event_search');
                    if ($date["eventTimeZone"]) {
                        $searchFilter = $searchFilter->setEventTimeZone($date["eventTimeZone"]);
                    }
                    if ($date["startDate"]) {
                        $searchFilter = $searchFilter->setStartDate(new \DateTime($date["startDate"]));
                    }
                    if ($date["endDate"]) {
                        $searchFilter = $searchFilter->setEndDate(new \DateTime($date["endDate"]));
                    }
                
                    $form = $this->createForm(MyEventSearchType::class, $searchFilter);
                    $qb = $repo->createQueryBuilderBySearchFilter($searchFilter);
                } else {
                    $qb = $repo->findByEventDay();
                }
            }
        
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
            'end' => $pagination_data['lastItemNumber'],
        ]);
    }
}
