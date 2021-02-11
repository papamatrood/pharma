<?php

namespace App\Controller;

use App\Entity\Familles;
use App\Form\FamillesType;
use App\Repository\FamillesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user/familles")
 */
class FamillesController extends AbstractController
{
    /**
     */
    public function index(FamillesRepository $famillesRepository): Response
    {
        return $this->render('familles/index.html.twig', [
            'familles' => $famillesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="familles_index")
     * @Route("/new", name="familles_new")
     * @Route("/{id}/edit", name="familles_edit")
     */
    public function new(Request $request, Familles $famille = null): Response
    {
        if(is_null($famille)){
            $famille = new Familles();
        }
        $entityManager = $this->getDoctrine()->getManager();
        $familles = $entityManager->getRepository(Familles::class)->findAll();

        $form = $this->createForm(FamillesType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($famille);
            $entityManager->flush();

            return $this->redirectToRoute('familles_new');
        }

        return $this->render('familles/new.html.twig', [
            'famille' => $famille,
            'familles' => $familles,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="familles_show")
     */
    public function show(Familles $famille)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $famille = $entityManager->getRepository(Familles::class)->find($famille);
        $response = new JsonResponse();
        return $response->setData(['famille' => $famille->getNom()]);
    }

    /**
     */
    public function edit(Request $request, Familles $famille): Response
    {
        $form = $this->createForm(FamillesType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('familles_index');
        }

        return $this->render('familles/edit.html.twig', [
            'famille' => $famille,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="familles_delete")
     */
    public function delete(Request $request, Familles $famille)
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($famille);
            $entityManager->flush();

        return $this->redirectToRoute('familles_new');
    }
}
