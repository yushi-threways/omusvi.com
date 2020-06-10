<?php

namespace App\Controller;

use App\Form\Type\ContactFormType;
use App\Service\Mailer\TwigSwiftMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @package App\Controller
 * @Route("/contact")
 */
class ContactController extends Controller
{
    const SESSION_KEY = 'om_contact';
    /**
     * @Route("/", name="contact_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);

        $form = $this->createForm(ContactFormType::class, $data);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session->set(self::SESSION_KEY, $form->getData());
                return $this->redirectToRoute('contact_confirm');
            }
        }
        return array(
            'form' => $form->createView(),
        );
    }
    /**
     * @Route("/confirm", name="contact_confirm")
     * @Template()
     */
    public function confirmAction(Request $request, TwigSwiftMailer $mailer)
    {
        $session = $request->getSession();
        $data = $session->get(self::SESSION_KEY);
        if (!$data) {
            return $this->redirectToRoute('contact_index');
        }

        $form = $this->createFormBuilder()->getForm();
        $form->setData($data);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $mailer->sendMessage('_email/contact.txt.twig', [
                    'data' => $data,
                ]);
                $session->remove(self::SESSION_KEY);
                return $this->redirectToRoute('contact_complete');
            }
        }

        return array(
            'form' => $form->createView(),
            'data' => $data,
        );
    }

    /**
     * @Route("/complete", name="contact_complete")
     * @Template()
     */
    public function completeAction(Request $request)
    {
            return array(
            // ...
        );
    }
}
