<?php

namespace App\Controller;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Form\Type\MyEventApplicationType;
use App\Repository\MyEventApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/event/schedule/{id}")
 */
class MyEventApplicationController extends AbstractController
{

    const SESSION_KEY = 'op_my_event'; 


    /**
     * @param MyEventSchedule $schedule
     * @Route("/", name="my_event_application_index", methods={"GET"})
     */
    public function index(MyEventSchedule $schedule): Response
    {
        return $this->render('my_event_application/index.html.twig', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * @param Request $request
     * @param MyEventSchedule $schedule
     * @Route("/confirm", name="my_event_application_confirm")
     */
    public function confirm(Request $request, MyEventSchedule $schedule): Response
    {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);

        if (!$data) {
            return $this->redirectToRoute('my_event_show', ['id' => $myEvent->getId()]);
        }
        
        $form = $this->createForm(ConfirmFormType::class, $data);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($data);
                $entityManager->flush();

                $session->remove(self::SESSION_KEY);

               return $this->redirectToRoute('my_event_application_complete', ['id' => $myEvent->getMyEventSchedule()->getId()]);
            }
        }
        return $this->render('my_event_application/confirm.html.twig', [
            'form' => $form->createView(),
            'myEvent' => $myEvent,
            'data' => $data,
         ]);
    }    

       /**
     * @param Request $request
     * @param MyEventSchedule $schedule
     *
     * @Route("/complete", name="my_event_application_complete")
     */
    public function complete(Request $request, MyEventSchedule $schedule)
    {
         /** @var User $user */
         $user = $this->getUser();
         if (!is_object($user) || !$user instanceof UserInterface) {
             throw new AccessDeniedException('This user does not have access to this section.');
         }

        return $this->render('my_event_application/complete.html.twig', [
            'schedule' => $schedule,
        ]);   
    }
}
