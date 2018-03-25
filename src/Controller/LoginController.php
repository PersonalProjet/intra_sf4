<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class LoginController extends Controller
{
    /**
     * @Route("/", name="login_page")
     */
    public function indexAction(Environment $twig, ContainerInterface $container)
    {
        $securityContext = $container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $response = $this->forward('App\Controller\LoginController::home');
        } else {
            $response = $twig->render('login/index.html.twig');
        }
        return new Response($response);
    }

    /**
     * @Route("/logout", name="logout_page")
     */
    public function logout()
    {
    }

    /**
     * @Route("/home", name="home_index")
     */
    public function home()
    {
        return new Response('ok');
    }
}
