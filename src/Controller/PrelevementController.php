<?php

namespace App\Controller;

use App\Entity\Prelevement;
use App\Form\PrelevementType;
use App\Repository\PrelevementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prelevement")
 */
class PrelevementController extends Controller
{
    /**
     * @Route("/", name="prelevement_index", methods="GET")
     */
    public function index(PrelevementRepository $prelevementRepository): Response
    {
        return $this->render('prelevement/index.html.twig', ['prelevements' => $prelevementRepository->findAll()]);
    }

    /**
     * @Route("/new", name="prelevement_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $prelevement = new Prelevement();
        $form = $this->createForm(PrelevementType::class, $prelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prelevement);
            $em->flush();

            return $this->redirectToRoute('prelevement_index');
        }

        return $this->render('prelevement/new.html.twig', [
            'prelevement' => $prelevement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prelevement_show", methods="GET")
     */
    public function show(Prelevement $prelevement): Response
    {
        return $this->render('prelevement/show.html.twig', ['prelevement' => $prelevement]);
    }

    /**
     * @Route("/{id}/edit", name="prelevement_edit", methods="GET|POST")
     */
    public function edit(Request $request, Prelevement $prelevement): Response
    {
        $form = $this->createForm(PrelevementType::class, $prelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prelevement_edit', ['id' => $prelevement->getId()]);
        }

        return $this->render('prelevement/edit.html.twig', [
            'prelevement' => $prelevement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prelevement_delete", methods="DELETE")
     */
    public function delete(Request $request, Prelevement $prelevement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prelevement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($prelevement);
            $em->flush();
        }

        return $this->redirectToRoute('prelevement_index');
    }
}
