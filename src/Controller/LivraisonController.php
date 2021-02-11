<?php

namespace App\Controller;

use App\Entity\Caisse;
use DateTime;
use App\Entity\Produits;
use App\Entity\Commandes;
use App\Entity\Fournisseurs;
use App\Entity\Stock;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/livraison")
 */
class LivraisonController extends AbstractController
{
    /**
     * @Route("/liste/", name="livraison_list")
     */
    public function index(CommandesRepository $commandesRepository)
    {
        $livraisons = $commandesRepository->findAll();
        return $this->render('livraison/index.html.twig', [
            'livraisons' => $livraisons,
        ]);
    }

    /**
     * @Route("/supprimer/{id}/{idL}/", name="produit_livraison_delete")
     */
    public function supprimer($id, $idL, Request $request)
    {
        $session = $request->getSession();
        $livraison = $session->get('livraison');
        if (array_key_exists($id, $livraison['produits'])) {
            unset($livraison['produits'][$id]);
            $session->set('livraison', $livraison);
            $this->addFlash('success', 'Article supprimé avec succès !');
        }
        return $this->redirectToRoute('livraison', ['id' => $idL]);
    }

    /**
     * @Route("/livraison/{id}", name="livraison")
     */
    public function livraison(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        if (!$session->has('livraison')) {
                $commande = $entityManager->getRepository(Commandes::class)->find($id);
                $livraison = [];
                $livraison['id']                 =  $commande->getId();
                $livraison['valider']            =  $commande->getValider();
                $livraison['reference']          =  $commande->getReference();
                $livraison['dateCommandeAt']     =  $commande->getdateCommandeAt();
                $livraison['utilisateur']        =  $commande->getUtilisateur();
                $livraison['produits']           =  $commande->getProduits()['produits'];
                $livraison['idFournisseur']      =  $commande->getProduits()['idFournisseur'];
                $livraison['numeroFournisseur']  =  $commande->getProduits()['numeroFournisseur'];
                $livraison['nomFournisseur']     =  $commande->getProduits()['nomFournisseur'];
                
                $session->set('livraison', $livraison);
        }
        
        $fournisseurs  = $entityManager->getRepository(Fournisseurs::class)->findAll();
        $produits      = $entityManager->getRepository(Produits::class)->findAll();

        $livraison = $session->get('livraison');
        if (is_array($livraison)) {
            $reference = $livraison['reference'];
        }else {
            $reference = $livraison->getReference();
        }

        if ($request->isMethod('GET') && ($request->query->get('produit') != null)) {
            $id = (int) $request->query->get('produit');
            if (array_key_exists($id, $livraison['produits'])) {
                if ($request->query->get('quantite') != null && $request->query->get('prix') != null) {
                    $livraison['produits'][$id]['quantite'] = (int) $request->query->get('quantite');
                    $livraison['produits'][$id]['prix'] = (int) $request->query->get('prix');
                }else {
                    $livraison['produits'][$id]['quantite'] = 1;
                    $livraison['produits'][$id]['prix'] = 1;
                }

                $this->addFlash('success', 'Quantité modifié avec succès !');
            } else {
                $livraison['produits'][$id] = [];

                if ($request->query->get('quantite') != null && $request->query->get('prix') != null) {
                    $livraison['produits'][$id]['quantite'] = (int) $request->query->get('quantite');
                    $livraison['produits'][$id]['prix'] = (int) $request->query->get('prix');
                } else {
                    $livraison['produits'][$id]['quantite'] = 1;
                    $livraison['produits'][$id]['prix'] = 1;
                }

                $this->addFlash('success', 'Article ajouté avec succès !');
                $livraison['produits'][$id]['idProduit'] = (int) $request->query->get('produit');
                $livraison['produits'][$id]['codeProduit'] = $request->query->get('code');
                $livraison['produits'][$id]['designationProduit'] = $request->query->get('designation');
            }

            $session->set('livraison', $livraison);

            return $this->redirectToRoute('livraison', ['id'=> $id]);
        }
        
        return $this->render('livraison/new.html.twig', [
            'fournisseurs' => $fournisseurs,
            'produits' => $produits,
            'reference' => $reference,
            'livraisons' => $livraison
        ]);
    }

    /**
     * @Route("/annule/{id}", name="livraison_annule")
     */
    public function annule(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $livraison = $entityManager->getRepository(Commandes::class)->find($id);
        $produits = $livraison->getProduits();
        $dateLivraison = $livraison->getDateCommandeAt()->format('Y-m-d');

        foreach ($produits['produits'] as $p) {
            $produit = $entityManager->getRepository(Produits::class)->find($p['idProduit']);
            $caisse = $entityManager->getRepository(Caisse::class)->findBy(['dateAt' => $dateLivraison, 'motif' => "Livraison: {$p['designationProduit']}"])[0];
            $stock = $entityManager->getRepository(Stock::class)->findBy(['dateAt' => $dateLivraison, 'code' => $p['codeProduit'] ])[0];
            
            $quantite = $produit->getQuantite() - $p['quantite'];
            $produit->setQuantite($quantite);
            $produit->setPrixUnitaire(0);

            $entityManager->persist($produit);
            $entityManager->remove($caisse);
            $entityManager->remove($stock);
        }
        $livraison->setValider(false);

        $entityManager->persist($livraison);
        $entityManager->flush();

        return $this->redirectToRoute('livraison_list');
    }

    /**
     * @Route("/validation/{id}", name="livraison_validation")
     */
    public function validation($id, Request $request)
    {
        $session = $request->getSession();
        foreach ($session->get('livraison')['produits'] as $produit) {
            if (!isset($produit['prix'])) {
                $this->addFlash('errors', 'Veuillez donner un prix à tout les produits.');
                return $this->redirectToRoute('livraison', ['id' => $id]);
            }
        }

        $entityManager = $this->getDoctrine()->getManager();

        foreach ($session->get('livraison')['produits'] as $p) {
            $produit = $entityManager->getRepository(Produits::class)->find($p['idProduit']);
            $quantite = $produit->getQuantite() + $p['quantite'];
            $produit->setQuantite($quantite);
            $produit->setPrixUnitaire($p['prix']);

            $caisse = new Caisse();
            $caisse->setMotif("Livraison: ". $p['designationProduit']);
            $caisse->setSortie($p['quantite'] * $p['prix']);
            $caisse->setEntre(0);
            $caisse->setSolde(- $p['quantite'] * $p['prix']);
            $date = new DateTime('now');
            $now = $date->format('Y-m-d');
            $caisse->setDateAt($now);

            $stock = new Stock();
            $stock->setCode($p['codeProduit']);
            $stock->setDesignation($p['designationProduit']);
            $stock->setSortie(0);
            $stock->setEntre($p['quantite']);
            $stock->setSituation($quantite);
            $stock->setDateAt($now);

            $entityManager->persist($produit);
            $entityManager->persist($caisse);
            $entityManager->persist($stock);
        }
        $utilisateur = $this->getUser();
        $dateLivraison = $request->query->get('dateCommande');

        $produits['produits'] = $session->get('livraison')['produits'];
        $produits['idFournisseur'] = (int) $request->query->get('fournisseur');
        $produits['numeroFournisseur'] = $request->query->get('numero');
        $produits['nomFournisseur'] = $request->query->get('nomFournisseur');

        $livrer = $entityManager->getRepository(Commandes::class)->find($id);
        $livrer->setValider(true);
        $livrer->setDateCommandeAt(new DateTime($dateLivraison));
        $livrer->setUtilisateur($utilisateur);
        $livrer->setProduits($produits);

        $entityManager->persist($livrer);
        $entityManager->flush();

        $session->remove('livraison');

        return $this->redirectToRoute('livraison_list');
    }
}
