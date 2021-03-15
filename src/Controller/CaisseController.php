<?php

namespace App\Controller;

use App\Entity\Caisse;
use App\Form\CaisseType;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\CaisseRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/caisse")
 */
class CaisseController extends AbstractController
{
    /**
     * @Route("/situation/", name="caisse_pdf")
     */
    public function situation(CaisseRepository $caisseRepository): Response
    {
        $caisses = $caisseRepository->findAll();
        $html = $this->renderView('caisse/caissesPDF.html.twig', ['caisses' => $caisses]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Caisses ');
        $html2pdf->pdf->SetSubject('Caisses DevAndClick');
        $html2pdf->pdf->SetKeywords('Caisses,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('caisses.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }

    /**
     * @Route("/", name="liste_approvisionnement")
     * @Route("/approvisionnement", name="caisse_approvisionnement")
     * @Route("/{id}/edit", name="edit_approvisionnement")
     */
    public function approvisionnement(Request $request, Caisse $caisse = null): Response
    {
        if (is_null($caisse)) {
            $caisse = new Caisse();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $approvisionnements = $entityManager->getRepository(Caisse::class)->findBy(['sortie' => 0], ['dateAt' => 'DESC']);

        $form = $this->createForm(CaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entree = (int) $caisse->getEntre();
            $sortie = (int) $caisse->getSortie();
            $solde = $caisse->getEntre() - (int) $caisse->getSortie();
            $caisse->setEntre($entree);
            $caisse->setSortie($sortie);
            $caisse->setSolde($solde);
            $date = new DateTime('now');
            $now = $date->format('Y-m-d H:i:s');
            $caisse->setDateAt($now);
            
            $entityManager->persist($caisse);
            $entityManager->flush();

            return $this->redirectToRoute('liste_approvisionnement');
        }

        return $this->render('caisse/approvisionnement.html.twig', [
            'caisse' => $caisse,
            'approvisionnements' => $approvisionnements,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/approvisionnement/delete/{id}", name="delete_approvisionnement", methods={"DELETE","POST"})
     */
    public function deleteApprovisionnement(Request $request, Caisse $approvisionnement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approvisionnement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($approvisionnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('liste_approvisionnement');
    }

    /**
     * @Route("/depense", name="caisse_depense")
     * @Route("/depense/{id}/edit", name="edit_depense")
     */
    public function depense(Request $request, Caisse $caisse = null): Response
    {
        if (is_null($caisse)) {
            $caisse = new Caisse();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $depenses = $entityManager->getRepository(Caisse::class)->findBy(['entre' => 0], ['dateAt' => 'DESC']);

        $form = $this->createFormBuilder($caisse)
            ->add('motif', null, [
                'label' => 'Motif de la dépense'
            ])
            ->add('sortie', null, [
                'label' => 'Montant'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entree = (int) $caisse->getEntre();
            $sortie = (int) $caisse->getSortie();
            $solde = $caisse->getEntre() - (int) $caisse->getSortie();
            $caisse->setEntre($entree);
            $caisse->setSortie($sortie);
            $caisse->setSolde($solde);
            $date = new DateTime('now');
            $now = $date->format('Y-m-d H:i:s');
            $caisse->setDateAt($now);

            $entityManager->persist($caisse);
            $entityManager->flush();

            return $this->redirectToRoute('caisse_depense');
        }

        return $this->render('caisse/depense.html.twig', [
            'caisse' => $caisse,
            'depenses' => $depenses,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/depense/delete/{id}", name="delete_depense", methods={"DELETE","POST"})
     */
    public function deleteDepense(Request $request, Caisse $depense): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($depense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caisse_depense');
    }

    /**
     * @Route("/{id}", name="caisse_show", methods={"GET"})
     */
    public function show(Caisse $caisse): Response
    {
        return $this->render('caisse/show.html.twig', [
            'caisse' => $caisse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caisse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Caisse $caisse): Response
    {
        $form = $this->createForm(CaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caisse_index');
        }

        return $this->render('caisse/edit.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caisse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Caisse $caisse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caisse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caisse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caisse_index');
    }
}
