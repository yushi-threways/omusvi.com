<?php
declare(strict_types=1);

namespace App\Controller\Mypage;

use App\Entity\BankAccount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Type\BankAccountFormType;
use App\Repository\BankAccountRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfileController
 * @package App\Controller\Mypage
 * @Route("/mypage/bank/account")
 */
class BankAccountController extends AbstractController
{
    
    /**
     * @return Response
     *
     * @Route("/", name="mypage_bank_account")
     */
    public function index()
    {
        /** @var BankAccountRepository $repo */
        $repo = $this->getDoctrine()->getRepository(BankAccount::class);
        $account = $repo->find($this->getUser());
        
        return $this->render('my_page/bank/index.html.twig', [
            'account' => $account,
        ]);
    }
    
    /**
     * @param Request $request
     * @return Response
     * @Route("/edit", name="mypage_bank_account_edit")
     */
    public function edit(Request $request): Response
    {
        /** @var BankAccountRepository $repo */
        $repo = $this->getDoctrine()->getRepository(BankAccount::class);
        $account = $repo->findOrCreateByUser($this->getUser());
    
        $form = $this->createForm(BankAccountFormType::class, $account);

        if($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($account);
                $em->flush();
                $this->addFlash("success", "口座情報を登録・更新しました");
                return $this->redirectToRoute('mypage_detail_index');
            }
        }

        return $this->render('my_page/bank/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
