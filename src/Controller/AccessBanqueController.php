<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserCompteType;
use App\Repository\CompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Banque;
use App\Form\UserBanqueType;
use App\Repository\BanqueRepository;

/**
 * @Route("/admin/assos")
 */
class AccessBanqueController extends AbstractController
{
    /**
     * @Route("/compte", name="user_compte_new")
     */
    public function accessCompte(Request $request, CompteRepository $compteRepository): Response
    {
        $user = $this->getUser();
        $comptes = $user->getCompte();
        $form = $this->createForm(UserCompteType::class, $comptes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $request->request->get('user_compte')['name'];

            if (!empty($datas)){
                $em = $this->getDoctrine()->getManager();

                foreach($comptes as $compte){
                    $user->removeCompte($compte);
                }

                $em->persist($user);
                $em->flush();

                foreach($datas as $id){
                    $compte = $compteRepository->find($id);
                    $user->addCompte($compte);
                }

                $em->persist($user);
                $em->flush();
            }
        }

        return $this->render('accessbanque/compte.html.twig', [
            'comptes' => $comptes,
            'form' => $form->createView(),
        ]);
    }
}
