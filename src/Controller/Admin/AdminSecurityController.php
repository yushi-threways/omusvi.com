<?php
declare(strict_types=1);
namespace App\Controller\Admin;

use App\Form\Type\AdminLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

/**
 * Class AdminSecurityController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class AdminSecurityController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/login", name="admin_login")
     */
    public function login(Request $request): Response
    {
        /** @var $session Session */
        $session = $request->getSession();
        
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        } else {
            $error = null;
        }
        if (!$error instanceof AuthenticationException) {
            $error = null;
        }
        
        $form = $this->createForm(AdminLoginType::class);
        return $this->render("admin/admin_security/login.html.twig", [
            'error' => $error,
            "form" => $form->createView()
        ]);
    }
    
    /**
     * @Route("/logout", name="admin_logout")
     */
    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
