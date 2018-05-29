<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    public function navigation()
    {
        $comptes = $this->getUser()->getCompte();
        $banques = [];

        foreach ($comptes as $compte) {
            $banques[$compte->getBanque()->getName()][] = [
                'id' => $compte->getId(),
                'lib' => $compte->getName(),
            ];
        }

        return $this->render('navigation.html.twig', [
            'banques' => $banques,
        ]);
    }
}
