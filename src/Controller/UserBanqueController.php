<?php

namespace App\Controller;

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
class UserBanqueController extends AbstractController
{
    /**
     * @Route("/", name="user_banque_new")
     */
    public function new(Request $request, BanqueRepository $banqueRepository): Response
    {
        $user = $this->getUser();
        $banques = $banqueRepository->findBanqueByUser($user->getId());
        $form = $this->createForm(UserBanqueType::class, $banques);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $request->request->get('user_banque')['name'];

            if (!empty($datas)){
                $em = $this->getDoctrine()->getManager();

                foreach($banques as $banque){
                    $banque = $banqueRepository->find($banque->getId());
                    $user->removeBanque($banque);
                }

                $em->persist($user);
                $em->flush();

                foreach($datas as $id){
                    $banque = $banqueRepository->find($id);
                    $user->addBanque($banque);
                }

                $em->persist($user);
                $em->flush();
            }
        }

        return $this->render('userbanque/new.html.twig', [
            'banques' => $banques,
            'form' => $form->createView(),
        ]);
    }
}
