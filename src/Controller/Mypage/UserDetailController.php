<?php

namespace App\Controller\Mypage;

use App\Entity\UserDetail;
use App\Entity\User;
use App\Form\Type\UserDetailType;
use App\Form\Type\ConfirmFormType;
use App\DBAL\Types\GenderEnumType;
use App\Repository\UserDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/mypage/detail")
 */
class UserDetailController extends AbstractController
{
    
    const SESSION_KEY = 'op_user_detail';

    /**
     * @Route("/", name="mypage_detail_index", methods={"GET"})
     */
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $detail = $user->getUserDetail();

        return $this->render('my_page/user_detail/index.html.twig', [
            'user' => $user,
            'detail' => $detail,
        ]);
    }

    /**
     * @Route("/edit", name="mypage_detail_edit")
     */
    public function edit(Request $request): Response
    {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);
        $form = $this->createForm(UserDetailType::class, $data);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session->set(self::SESSION_KEY, $form->getData());
                return $this->redirectToRoute('mypage_detail_confirm');
            }
        }

        return $this->render('my_page/user_detail/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/confirm", name="mypage_detail_confirm")
     * @Template()
     */
    public function confirm(Request $request): Response
    {
        $user = $this->getUser();        
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);
        $data->setUser($user);
        if (!$data) {
            return $this->redirectToRoute('mypage_detail_index');
        }
        $form = $this->createForm(ConfirmFormType::class, $data);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($data);
                $entityManager->flush();
                $session->remove(self::SESSION_KEY);
               $this->addFlash('success', 'ユーザー情報を更新しました。');
               return $this->redirectToRoute('mypage_detail_index');
            }
        }

        return $this->render('my_page/user_detail/confirm.html.twig',[
            'form' => $form->createView(),
            'detail' => $data,
            'gender' => GenderEnumType::getReadableValue($data->getGender()),
        ]);
    }
}
