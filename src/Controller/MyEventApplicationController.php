<?php

namespace App\Controller;

use App\Entity\MyEventApplication;
use App\Entity\MyEventSchedule;
use App\Entity\UserDetail;
use App\Form\Type\MyEventApplicationType;
use App\Form\Type\ConfirmFormType;
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
            return $this->redirectToRoute('my_event_show', ['id' => $schedule->getMyEvent->getId()]);
        }

        $user = $this->getUser();

        $form = $this->createForm(ConfirmFormType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $data->setUser($user);
            $data->setMyEventSchedule($schedule);
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            $session->set(self::SESSION_KEY, $form->getData());
            return $this->redirectToRoute('my_event_application_complete', ['id' => $schedule->getId()]);
        }

        return $this->render('my_event_application/confirm.html.twig', [
            'form' => $form->createView(),
            'schedule' => $schedule,
            'data' => $data,
            'detail' => $user->getUserDetail(),
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
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);

        if (!$data) {
            return $this->redirectToRoute('my_event_show', ['id' => $schedule->getId()]);
        }

        $session->remove(self::SESSION_KEY);
        return $this->render('my_event_application/complete.html.twig', [
            'schedule' => $schedule
        ]);
    }
}
