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
use App\Model\SearchFilter\EventSearchFilter;
use App\Form\Type\MyEventSearchType;

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
    public function index(Request $request, string $_format, MyEventRepository $myEventRepository): Response
    {

        $searchFilter = new EventSearchFilter();

        $form = $this->createForm(MyEventSearchType::class, $searchFilter);   
        $form->remove('tag');     
        $form->remove('prefecture');     
        $myEvent = $myEventRepository->findOneByLatestEvent();
        $myEvents = $myEventRepository->findLatestEvent(2);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->handleRequest($request);
            $request->query->set($searchFilter, $form->getData());
            return $this->redirectToRoute('my_event_search');
            }
        
        return $this->render('default/index.' . $_format . '.twig', [
            'feature_my_event' => $myEvent,
            'my_events' => $myEvents,
            'search_form' => $form->createView()
        ]);
    }
}
