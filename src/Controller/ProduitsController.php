<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user/produits")
 */
class ProduitsController extends AbstractController
{

    private $produitsDisponible = [];
    private $repository;

    public function __construct(ProduitsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="produits_index")
     */
    public function index(): Response
    {
        $titre = "disponibles";
        return $this->render('produits/index.html.twig', [
            'produits' => $this->disponible(),
            'titre' => $titre
        ]);
    }


    /**
     * @Route("/peremption/encours/", name="produits_encours")
     */
    public function peremptionEncours()
    {
        $titre = "en cours de péremption";
        $produits = $this->repository->findAllEncours();
        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'titre' => $titre
        ]);
    }


    /**
     * @Route("/peremption/perimes/", name="produits_perimes")
     */
    public function peremptionPerimes()
    {
        $titre = "périmés";
        $produits = $this->repository->findAllPerimes();
        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'titre' => $titre
        ]);
    }

    /**
     * @Route("/new", name="produits_new")
     * @Route("/{id}/edit", name="produits_edit")
     */
    public function new(Request $request, Produits $produit = null): Response
    {
        if (is_null($produit)) {
            $produit = new Produits();
        }
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_show", methods={"GET"})
     */
    public function show(Produits $produit): Response
    {
        $produits = $this->disponible();
        foreach ($produits as $p) {
            if ($produit->getId() == $p->getId()) {
                $produit = $p;
                break;
            }
        }
        $designation = $produit->getDesignation();
        $code = $produit->getCode();
        $pu = $produit->getPrixUnitaire();
        $response = new JsonResponse();
        return $response->setData([
            'designation' => $designation,
            'code' => $code,
            'pu' => $pu
        ]);
    }

    /**
     */
    public function edit(Request $request, Produits $produit): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="produits_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produits $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produits_index');
    }

    private function disponible(): ?array
    {
        if (empty($this->produitsDisponible)) {
            $this->produitsDisponible = $this->repository->findAllDisponible();
        }
        return $this->produitsDisponible;
    }
}
