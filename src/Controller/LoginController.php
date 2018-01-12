<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class LoginController
{
    /**
     * @Route("/", name="login")
     */
    public function login(Environment $twig)
    {
        return new Response($twig->render('login/index.html.twig'));
    }
}
