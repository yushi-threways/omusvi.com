<?php

namespace App\Controller;

use App\Entity\MyEvent;
use App\Entity\MyEventSchedule;
use App\Entity\User;
use App\Entity\UserDetail;
use App\Entity\MyEventApplication;
use App\Form\Type\MyEventApplicationMenType;
use App\Form\Type\MyEventApplicationWomanType;
use App\Form\Type\ConfirmFormType;
use App\Repository\MyEventRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DBAL\Types\GenderEnumType;

/**
 * @Route("/event")
 */
class MyEventController extends AbstractController
{

    const SESSION_KEY = 'op_my_event'; 

    /**
     * @Route("/", name="my_event_index", methods={"GET"})
     */
    public function index(Request $request, MyEventRepository $myEventRepository, TagRepository $tagRepository): Response
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
     * @Route("/{id}", name="my_event_show", methods={"GET", "POST"})
     */
    public function show(Request $request, MyEvent $myEvent): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var UserDetailRepository $repo */
        $repo = $this->getDoctrine()->getRepository(UserDetail::class);
        $detail = $repo->findOneBy(['user' => $user]);
        
        if (!$detail == null) {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);
        $data = new MyEventApplication();
        $data->setUser($user);
        $data->setMyEventSchedule($myEvent->getMyEventSchedule());
        
        if ($user->getUserDetail()->getGender() == GenderEnumType::MALE) {
            $form = $this->createForm(MyEventApplicationMenType::class, $data);
        } elseif ($user->getUserDetail()->getGender() == GenderEnumType::FEMALE) {
            $form = $this->createForm(MyEventApplicationWomanType::class, $data);
        }

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session->set(self::SESSION_KEY, $form->getData());
                return $this->redirectToRoute('my_event_application_confirm', ['id' => $myEvent->getMyEventSchedule()->getId()]);
            }
        }
            // if ($form->isSubmitted() && $form->isValid()) {
            //     $entityManager = $this->getDoctrine()->getManager();
            //     $entityManager->persist($myEventApplication);
            //     $entityManager->flush();
        
            //     return $this->redirectToRoute('my_event_application_complete', ['id' => $myEvent->getMyEventSchedule()->getId()]);
            // }

            return $this->render('my_event/show.html.twig', [
                'my_event' => $myEvent,
                'user' => $user,
                'form' => $form->createView(),
             ]);
        } else {
            return $this->render('my_event/show.html.twig', [
                'my_event' => $myEvent,
                'user' => $user,
                // 'form' => $form->createView(),
             ]);
        }
    }

    /**
     * @Route("/{id}", name="my_event_confirm", methods={"GET", "POST"})
     */
    public function confirm(Request $request, MyEvent $myEvent): Response
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
}
