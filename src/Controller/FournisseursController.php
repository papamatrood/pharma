<?php

namespace App\Controller;

use App\Entity\Fournisseurs;
use App\Form\FournisseursType;
use App\Repository\FournisseursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user/fournisseurs")
 */
class FournisseursController extends AbstractController
{

    protected $repository;
    protected $allFournisseur;

    public function __construct(FournisseursRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="fournisseurs_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('fournisseurs/index.html.twig', [
            'fournisseurs' => $this->allFournisseur(),
        ]);
    }

    /**
     * @Route("/new", name="fournisseurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fournisseur = new Fournisseurs();
        $form = $this->createForm(FournisseursType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->redirectToRoute('fournisseurs_index');
        }

        return $this->render('fournisseurs/new.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fournisseurs_show", methods={"GET"})
     */
    public function show(Fournisseurs $fournisseur): Response
    {
        $fournisseurs = $this->allFournisseur();
        foreach ($fournisseurs as $f) {
            if ($fournisseur->getId() == $f->getId()) {
                $fournisseur = $f;
                break;
            }
        }
        $nomPrenom = $fournisseur->getPrenom().' '. $fournisseur->getNom();
        $numero = $fournisseur->getNumero();
        $response = new JsonResponse();
        return $response->setData([
            'fournisseur' => $nomPrenom, 'numero' => $numero
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fournisseurs_edit", methods={"GET","POST"})
     */
    public function edit(Fournisseurs $fournisseur, Request $request): Response
    {
        $form = $this->createForm(FournisseursType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fournisseurs_index');
        }

        return $this->render('fournisseurs/edit.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="fournisseurs_delete", methods={"DELETE"})
     */
    public function delete(Fournisseurs $fournisseur, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fournisseur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fournisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fournisseurs_index');
    }

    private function allFournisseur(): ?array
    {
        if (empty($this->allFournisseur)) {
            $this->allFournisseur = $this->repository->findAll();
        }
        return $this->allFournisseur;
    }
}
