<?php

namespace App\Controller;

use DateTime;
use App\Entity\Produits;
use App\Entity\Commandes;
use App\Entity\Fournisseurs;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commandes")
 */
class CommandesController extends AbstractController
{
    /**
     * @Route("/", name="commandes_index")
     */
    public function index(CommandesRepository $commandesRepository): Response
    {
        $commandes = $commandesRepository->findAll();
        return $this->render('commandes/index.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * @Route("/new", name="commandes_new")
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $fournisseurs  = $entityManager->getRepository(Fournisseurs::class)->findAll();
        $produits      = $entityManager->getRepository(Produits::class)->findAllDisponible();
        $reference = 1;
        if (!is_null($entityManager->getRepository(Commandes::class)->findOneBy([]))) {
            $reference = $entityManager->getRepository(Commandes::class)->findOneBy([], ['id' => 'desc'])->getReference() + 1;
        }
        
        $session = $request->getSession();
        if (!$session->has('commande')) {
            $session->set('commande', []);
        }

        $commande = $session->get('commande');
        if (count($commande) == 0) $commande['produits'] = [];
        if ($request->isMethod('GET') && ($request->query->get('produit') != null)) {
            $id = (int) $request->query->get('produit');
            if (array_key_exists($id, $commande)) {
                if ($request->query->get('quantite') != null) {
                    $commande['produits'][$id]['quantite'] = (int) $request->query->get('quantite');

                    $this->addFlash('success', 'Quantité modifié avec succès !');
                }
            } else {
                $commande['produits'][$id] = [];

                if ($request->query->get('quantite') != null) {
                    $commande['produits'][$id]['quantite'] = (int) $request->query->get('quantite');
                } else {

                    $commande['produits'][$id]['quantite'] = 1;

                    $this->addFlash('success', 'Article ajouté avec succès !');
                }
                $commande['produits'][$id]['idProduit'] = (int) $request->query->get('produit');
                $commande['produits'][$id]['codeProduit'] = $request->query->get('code');
                $commande['produits'][$id]['designationProduit'] = $request->query->get('designation');
            }
            
            $session->set('commande', $commande);

            return $this->redirectToRoute('commandes_new');
        }
        return $this->render('commandes/new.html.twig', [
            'fournisseurs' => $fournisseurs,
            'produits' => $produits,
            'reference' => $reference,
            'commandes' => $commande
        ]);
    }

    /**
     * @Route("/edit/{idCommande}", name="commandes_edit")
     */
    public function edit($idCommande, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $commandes  = $entityManager->getRepository(Commandes::class)->find($idCommande);
        $reference = $commandes->getReference();
        $fournisseurs  = $entityManager->getRepository(Fournisseurs::class)->findAll();
        $produits      = $entityManager->getRepository(Produits::class)->findAll();

        $session = $request->getSession();
        if (empty($session->get('commande'))) {
            $session->set('commande', $commandes->getProduits());
        }

        $commande = $session->get('commande');
        
        if (count($commande) == 0) $commande['produits'] = [];
        if ($request->isMethod('GET') && ($request->query->get('produit') != null)) {
            $id = (int) $request->query->get('produit');
            if (array_key_exists($id, $commande)) {
                if ($request->query->get('quantite') != null) {
                    $commande['produits'][$id]['quantite'] = (int) $request->query->get('quantite');

                    $this->addFlash('success', 'Quantité modifié avec succès !');
                }
            } else {
                $commande['produits'][$id] = [];

                if ($request->query->get('quantite') != null) {
                    $commande['produits'][$id]['quantite'] = (int) $request->query->get('quantite');
                } else {

                    $commande['produits'][$id]['quantite'] = 1;

                    $this->addFlash('success', 'Article ajouté avec succès !');
                }
                $commande['produits'][$id]['idProduit'] = (int) $request->query->get('produit');
                $commande['produits'][$id]['codeProduit'] = $request->query->get('code');
                $commande['produits'][$id]['designationProduit'] = $request->query->get('designation');
            }

            $session->set('commande', $commande);

            return $this->redirectToRoute('commandes_edit', ['idCommande' => $idCommande ]);
        }
        return $this->render('commandes/edit.html.twig', [
            'fournisseurs' => $fournisseurs,
            'produits' => $produits,
            'reference' => $reference,
            'commandes' => $commande,
            'idCommande' => $idCommande
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="produit_commande_delete")
     */
    public function supprimer($id, Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('commande');
        if (array_key_exists($id, $commande['produits'])) {
            unset($commande['produits'][$id]);
            $session->set('commande', $commande);
            $this->addFlash('success', 'Article supprimé avec succès !');
        }

        $response = new JsonResponse();
        return $response->setData([
            'reponse' => 'true'
        ]);
    }

    /**
     * @Route("/edit/supprimer/{id}/{idCommande}", name="produit_commande_edit_delete")
     */
    public function supprimerEdit($id, $idCommande, Request $request)
    {
        $session = $request->getSession();
        $commande = $session->get('commande');
        if (array_key_exists($id, $commande['produits'])) {
            unset($commande['produits'][$id]);
            $session->set('commande', $commande);
            $this->addFlash('success', 'Article supprimé avec succès !');
        }
        return $this->redirectToRoute('commandes_edit', ['idCommande' => $idCommande]);
    }

    /**
     * @Route("/validation/{reference}", name="commande_validation")
     */
    public function validationCommande(Request $request, $reference)
    {
        $commande = new Commandes();
        $session = $request->getSession();
        $panier = $session->get('commande');
        $utilisateur = $this->getUser();
        $dateCommande = $request->query->get('dateCommande');
        $reference = (int) $reference;

        $panier['idFournisseur'] = (int) $request->query->get('fournisseur');
        $panier['numeroFournisseur'] = $request->query->get('numero');
        $panier['nomFournisseur'] = $request->query->get('nomFournisseur');
        
        $commande->setValider(false);
        $commande->setReference($reference);
        $commande->setDateCommandeAt(new DateTime($dateCommande));
        $commande->setUtilisateur($utilisateur);
        $commande->setProduits($panier);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $entityManager->flush();

        $session->remove('commande');

        return $this->redirectToRoute('commandes_index');
    }

    /**
     * @Route("/edit/validation/{idCommande}", name="commande_edit_validation")
     */
    public function validationEditCommande(Request $request, $idCommande)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $commande  = $entityManager->getRepository(Commandes::class)->find($idCommande);
        $session = $request->getSession();
        $panier = $session->get('commande');
        $utilisateur = $this->getUser();
        $dateCommande = $request->query->get('dateCommande');

        $panier['idFournisseur'] = (int) $request->query->get('fournisseur');
        $panier['numeroFournisseur'] = $request->query->get('numero');
        $panier['nomFournisseur'] = $request->query->get('nomFournisseur');

        $commande->setValider(false);
        $commande->setDateCommandeAt(new DateTime($dateCommande));
        $commande->setUtilisateur($utilisateur);
        $commande->setProduits($panier);
        
        $entityManager->persist($commande);
        $entityManager->flush();

        $session->remove('commande');

        return $this->redirectToRoute('commandes_index');
    }

    /**
     * @Route("/pdf/{id}", name="commandes_print")
     */
    public function pdf($id)
    {
        $em = $this->getDoctrine()->getManager();

        $facture = $em->getRepository(Commandes::class)->find($id);

        if (!$facture) {
            $this->addFlash('errors', 'Une erruer est survenue');
            return $this->redirectToRoute('commandes_index');
        }

        $html = $this->renderView('commandes/facturePDF.html.twig', ['facture' => $facture]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Facture ' . $facture->getReference());
        $html2pdf->pdf->SetSubject('Facture DevAndClick');
        $html2pdf->pdf->SetKeywords('Facture,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('Facture.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }

    /**
     * @Route("/{id}/delete", name="commandes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commandes $commande): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Suppression effectuée avec succès !');

        return $this->redirectToRoute('commandes_index');
    }
}
