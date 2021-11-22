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

    public function addToOrder(int $id) : void
    {
        $order = $this->getOrder();
        if (isset($order[$id])) {
            $order[$id]++;
        }else {
            $order[$id] = 1;
        }
        $this->updateOrder($order);
    }

    public function deleteFromOrder(int $id) : void
    {
        $order = $this->getOrder();
        if (isset($order[$id]) && ($order[$id] > 1)) {
            $order[$id]--;
        }else {
            unset($order[$id]);
        }
        $this->updateOrder($order);
    }

    public function deleteAllToOrder(int $id) : void
    {
        $order = $this->getOrder();
        if (isset($order[$id])) {
            unset($order[$id]);
            $this->updateOrder($order);
        }
    }

    public function deleteOrder() : void
    {
        $this->updateOrder([]);
    }

    public function updateOrder(array $order) : void
    {
        $this->session->set('order', $order);
    }

    public function getOrder() : ?array
    {
        return $this->session->get('order', []);
    }

}