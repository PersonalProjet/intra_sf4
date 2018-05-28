<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login_page")
     */
    public function indexAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $response = $this->redirectToRoute('home_index');
        } else {
            $response = $this->render('login/index.html.twig');
        }

        return $response;
    }

    /**
     * @Route("/logout", name="logout_page")
     */
    public function logout()
    {
    }
}
