<?php
namespace App\Services;

use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderServices {

    private $session;
    private $repoProduits;


    function __construct(SessionInterface $session, ProduitsRepository $repoProduits)
    {
        $this->session      = $session;
        $this->repoProduits = $repoProduits;
    }

    public function addToOrder(int $id, int $quantite, string $code, string $designation) : void
    {
        $commande = $this->getOrder();
        if (isset($commande['produits'][$id]['quantite'])) {
            $commande['produits'][$id]['quantite'] = $quantite;
        }else {
            $commande['produits'][$id]['quantite'] = $quantite;
            $commande['produits'][$id]['idProduit'] = $id;
            $commande['produits'][$id]['codeProduit'] = $code;
            $commande['produits'][$id]['designationProduit'] = $designation;
        }
        $this->updateOrder($commande);
    }

    public function incrementToOrder(int $id) : void
    {
        $commande = $this->getOrder();
        if (isset($commande['produits'][$id]['quantite'])) {
            $commande['produits'][$id]['quantite']++;
        }
        $this->updateOrder($commande);
    }

    public function decrementFromOrder(int $id) : void
    {
        $commande = $this->getOrder();
        if (isset($commande['produits'][$id]['quantite']) && ($commande['produits'][$id]['quantite'] > 1)) {
            $commande['produits'][$id]['quantite']--;
        }else {
            unset($commande['produits'][$id]);
        }
        $this->updateOrder($commande);
    }

    public function deleteAllToOrder(int $id) : void
    {
        $commande = $this->getOrder();
        if (isset($commande['produits'][$id])) {
            unset($commande['produits'][$id]);
            $this->updateOrder($commande);
        }
    }

    public function deleteOrder() : void
    {
        $this->updateOrder([]);
    }

    public function updateOrder(array $commande) : void
    {
        $this->session->set('commande', $commande);
    }

    public function getOrder() : ?array
    {
        return $this->session->get('commande', []);
    }

}