<?php

namespace App\Controller;

use DateTime;
use App\Entity\Stock;
use App\Entity\Caisse;
use App\Entity\Ventes;
use App\Entity\Clients;
use App\Entity\Produits;
use App\Repository\VentesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user/vente")
 */
class VentesController extends AbstractController
{
    /**
     * @Route("/", name="ventes_index")
     */
    public function index(VentesRepository $ventesRepository, Request $request)
    {
        if ($request->isMethod('GET') && ($request->query->get('recherche') != null)) {
            $recherche = new Datetime($request->query->get('recherche'));
        }else {
            $recherche = new DateTime('today');
        }

        $date = $recherche->format('Y-m-d');

        $ventes = $ventesRepository->findAllWithDate($date);

        //dd($ventes);
        
        //$ventes = $ventesRepository->findBy([],array('dateVenteAt' => 'DESC'));
        return $this->render('ventes/index.html.twig', [
            'ventes' => $ventes,
            'recherche' => $recherche,
        ]);
    }

    /**
     * @Route("/retour", name="ventes_retour")
     */
    public function retour(VentesRepository $ventesRepository, Request $request)
    {
        if ($request->isMethod('GET') && ($request->query->get('recherche') != null)) {
            $recherche = new Datetime($request->query->get('recherche'));
        }else {
            $recherche = new DateTime('today');
        }

        $date = $recherche->format('Y-m-d');

        $ventes = $ventesRepository->findAllWithDate($date);

        //dd($ventes);
        
        //$ventes = $ventesRepository->findBy([],array('dateVenteAt' => 'DESC'));
        return $this->render('ventes/retour.html.twig', [
            'ventes' => $ventes,
            'recherche' => $recherche,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="produit_vente_delete")
     */
    public function supprimer($id, Request $request)
    {
        $session = $request->getSession();
        $vente = $session->get('vente');
        if (array_key_exists($id, $vente['produits'])) {
            unset($vente['produits'][$id]);
            $session->set('vente', $vente);
            $this->addFlash('success', 'Article supprimé avec succès !');
        }
        return $this->redirectToRoute('ventes_new');
    }

    /**
     * @Route("/new", name="ventes_new")
     */
    public function new(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $clients  = $entityManager->getRepository(Clients::class)->findAll();
        $produits      = $entityManager->getRepository(Produits::class)->findAll();
        $reference = 1;
        if (!is_null($entityManager->getRepository(Ventes::class)->findOneBy([]))) {
            $reference = $entityManager->getRepository(Ventes::class)->findOneBy([], ['id' => 'desc'])->getReference() + 1;
        }

        $session = $request->getSession();
        if (!$session->has('vente')) {
            $session->set('vente', []);
        }

        $vente = $session->get('vente');
        if (count($vente) == 0) $vente['produits'] = [];
        if ($request->isMethod('GET') && ($request->query->get('produit') != null)) {
            $id = (int) $request->query->get('produit');
            if (array_key_exists($id, $vente)) {
                if ($request->query->get('quantite') != null) {
                    $vente['produits'][$id]['quantite'] = (int) $request->query->get('quantite');

                    $this->addFlash('success', 'Quantité modifié avec succès !');
                }
            } else {
                $vente['produits'][$id] = [];

                if ($request->query->get('quantite') != null) {
                    $vente['produits'][$id]['quantite'] = (int) $request->query->get('quantite');
                } else {

                    $vente['produits'][$id]['quantite'] = 1;

                    $this->addFlash('success', 'Article ajouté avec succès !');
                }
                $vente['produits'][$id]['idProduit'] = (int) $request->query->get('produit');
                $vente['produits'][$id]['codeProduit'] = $request->query->get('code');
                $vente['produits'][$id]['designationProduit'] = $request->query->get('designation');
                $vente['produits'][$id]['prix'] = $request->query->get('pu');
                $vente['produits'][$id]['remise'] = $request->query->get('remise');
                $vente['produits'][$id]['emballage'] = $request->query->get('emballage');
                $vente['produits'][$id]['brut'] = $request->query->get('brut');
                $vente['produits'][$id]['net'] = $request->query->get('net');
            }

            $session->set('vente', $vente);

            return $this->redirectToRoute('ventes_new');
        }
        return $this->render('ventes/new.html.twig', [
            'clients' => $clients,
            'produits' => $produits,
            'reference' => $reference,
            'ventes' => $vente
        ]);
    }

    /**
     * @Route("/edit/{idVente}", name="ventes_edit")
     */
    public function edit($idVente, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $ventes  = $entityManager->getRepository(Ventes::class)->find($idVente);
        $reference = $ventes->getReference();
        $clients  = $entityManager->getRepository(Clients::class)->findAll();
        $produits      = $entityManager->getRepository(Produits::class)->findAll();
        $session = $request->getSession();
        if (empty($session->get('vente'))) {
            $session->set('vente', $ventes->getProduits());
        }

        $vente = $session->get('vente');
        
        if (count($vente) == 0) $vente['produits'] = [];
        if ($request->isMethod('GET') && ($request->query->get('produit') != null)) {
            $id = (int) $request->query->get('produit');
            if (array_key_exists($id, $vente)) {
                if ($request->query->get('quantite') != null) {
                    $vente['produits'][$id]['quantite'] = (int) $request->query->get('quantite');

                    $this->addFlash('success', 'Quantité modifié avec succès !');
                }
            } else {
                $vente['produits'][$id] = [];

                if ($request->query->get('quantite') != null) {
                    $vente['produits'][$id]['quantite'] = (int) $request->query->get('quantite');
                } else {

                    $vente['produits'][$id]['quantite'] = 1;

                    $this->addFlash('success', 'Article ajouté avec succès !');
                }
                $vente['produits'][$id]['idProduit'] = (int) $request->query->get('produit');
                $vente['produits'][$id]['codeProduit'] = $request->query->get('code');
                $vente['produits'][$id]['designationProduit'] = $request->query->get('designation');
                $vente['produits'][$id]['prix'] = $request->query->get('pu');
                $vente['produits'][$id]['remise'] = $request->query->get('remise');
                $vente['produits'][$id]['emballage'] = $request->query->get('emballage');
                $vente['produits'][$id]['brut'] = $request->query->get('brut');
                $vente['produits'][$id]['net'] = $request->query->get('net');
            }

            $session->set('vente', $vente);

            return $this->redirectToRoute('ventes_edit', ['idVente' => $idVente ]);
        }
        return $this->render('ventes/edit.html.twig', [
            'clients' => $clients,
            'produits' => $produits,
            'reference' => $reference,
            'ventes' => $vente,
            'idVente' => $idVente
        ]);
    }

    /**
     * @Route("/edit/supprimer/{id}/{idVente}", name="produit_vente_edit_delete")
     */
    public function supprimerEdit($id, $idVente, Request $request)
    {
        $session = $request->getSession();
        $vente = $session->get('vente');
        if (array_key_exists($id, $vente['produits'])) {
            unset($vente['produits'][$id]);
            $session->set('vente', $vente);
            $this->addFlash('success', 'Article supprimé avec succès !');
        }
        return $this->redirectToRoute('ventes_edit', ['idVente' => $idVente]);
    }

    /**
     * @Route("/edit/validation/{idVente}/{reference}", name="vente_edit_validation")
     */
    public function validationEditVente(Request $request, $idVente)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $vente  = $entityManager->getRepository(Ventes::class)->find($idVente);
        $reference = $vente->getReference();
        $caisses  = $entityManager->getRepository(Caisse::class)->findBy(['reference' => $reference]);
        $stocks  = $entityManager->getRepository(Stock::class)->findBy(['reference' => $reference]);
        $date = $vente->getDateVenteAt()->format('Y-m-d');
        $session = $request->getSession();
        $panier = $session->get('vente');
        $utilisateur = $this->getUser();

        foreach ($panier['produits'] as $p) {
            $produit = $entityManager->getRepository(Produits::class)->find($p['idProduit']);
            $quantite = $produit->getQuantite() - $p['quantite'];
            $produit->setQuantite($quantite);
            $prix = (int) $p['prix'];

            $entree = (int) $p['quantite'] * $prix;
            $solde = (int) $p['quantite'] * $prix;

            foreach ($caisses as $caisse) {
                $entityManager->remove($caisse);
            }

            foreach ($stocks as $stock) {
                $entityManager->remove($stock);
            }

            $caisse = new Caisse();
            $caisse->setMotif("Vente: " . $p['designationProduit']);
            $caisse->setSortie(0);
            $caisse->setEntre($entree);
            $caisse->setSolde($solde);
            $caisse->setReference($reference);
            $caisse->setDateAt($date);

            $stock = new Stock();
            $stock->setCode($p['codeProduit']);
            $stock->setDesignation($p['designationProduit']);
            $stock->setSortie($p['quantite']);
            $stock->setEntre(0);
            $stock->setSituation($quantite);
            $stock->setReference($reference);
            $stock->setDateAt($date);
            
            $entityManager->persist($produit);
            $entityManager->persist($caisse);
            $entityManager->persist($stock);
        }
        $utilisateur = $this->getUser();

        $produits['produits'] = $session->get('vente')['produits'];
        $produits['idClient'] = (int) $request->query->get('client');
        $produits['numeroClient'] = $request->query->get('numero');
        $produits['nomClient'] = $request->query->get('prenomNom');
        $produits['adresse'] = $request->query->get('adresse');
        $produits['telephone'] = $request->query->get('telephone');

        $vente->setValider(true);
        $vente->setUtilisateur($utilisateur);
        $vente->setProduits($produits);
        $entityManager->persist($vente);
        $entityManager->flush();

        $session->remove('vente');

        return $this->redirectToRoute('ventes_retour');
    }

    /**
     * @Route("/ventesDuJour", name="ventes_jour")
     */
    public function ventesJour(VentesRepository $ventesRepository, Request $request)
    {
        if ($request->isMethod('GET') && ($request->query->get('recherche') != null)) {
            $recherche = new Datetime($request->query->get('recherche'));
        }else {
            $recherche = new DateTime('today');
        }

        $date = $recherche->format('Y-m-d');

        $ventes = $ventesRepository->findAllWithDate($date);
        
        return $this->render('ventes/ventesJour.html.twig', [
            'ventes' => $ventes,
            'recherche' => $recherche
        ]);
    }

    /**
     * @Route("/validation/{reference}", name="ventes_validation")
     */
    public function validation(Request $request, $reference)
    {
        $session = $request->getSession();
        foreach ($session->get('vente')['produits'] as $produit) {
            if (!isset($produit['prix'])) {
                $this->addFlash('errors', 'Veuillez donner un prix à tout les produits.');
                return $this->redirectToRoute('ventes_new');
            }
        }

        $entityManager = $this->getDoctrine()->getManager();

        foreach ($session->get('vente')['produits'] as $p) {
            $produit = $entityManager->getRepository(Produits::class)->find($p['idProduit']);
            $quantite = $produit->getQuantite() - $p['quantite'];
            $produit->setQuantite($quantite);

            $caisse = new Caisse();
            $caisse->setMotif("Vente: " . $p['designationProduit']);
            $caisse->setSortie(0);
            $caisse->setEntre($p['quantite'] * $p['prix']);
            $caisse->setSolde($p['quantite'] * $p['prix']);
            $caisse->setReference((int) $reference);
            $date = new DateTime('now');
            $now = $date->format('Y-m-d');
            $caisse->setDateAt($now);

            $stock = new Stock();
            $stock->setCode($p['codeProduit']);
            $stock->setDesignation($p['designationProduit']);
            $stock->setSortie($p['quantite']);
            $stock->setEntre(0);
            $stock->setSituation($quantite);
            $stock->setReference((int) $reference);
            $stock->setDateAt($now);
            
            $entityManager->persist($produit);
            $entityManager->persist($caisse);
            $entityManager->persist($stock);
        }
        $utilisateur = $this->getUser();
        $dateVente = $request->query->get('dateVente');

        $produits['produits'] = $session->get('vente')['produits'];
        $produits['idClient'] = (int) $request->query->get('client');
        $produits['numeroClient'] = $request->query->get('numero');
        $produits['nomClient'] = $request->query->get('prenomNom');
        $produits['adresse'] = $request->query->get('adresse');
        $produits['telephone'] = $request->query->get('telephone');

        $vente = new Ventes();
        $vente->setReference((int) $reference);
        $vente->setValider(true);
        $vente->setDateVenteAt(new DateTime($dateVente));
        $vente->setUtilisateur($utilisateur);
        $vente->setProduits($produits);

        $entityManager->persist($vente);
        $entityManager->flush();

        $session->remove('vente');

        return $this->redirectToRoute('ventes_index');
    }

    /**
     * @Route("/{id}/delete", name="ventes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ventes $vente)
    {
        if ($this->isCsrfTokenValid('delete' . $vente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vente);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Suppression effectuée avec succès !');

        return $this->redirectToRoute('ventes_retour');
    }
}
