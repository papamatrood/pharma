<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(ProduitsRepository $produitsRepository, Request $request)
    {
        $products = $produitsRepository->findStockFaible();
        
        $session = $request->getSession();
        if (!$session->has('stockFaible')) {
            $session->set('stockFaible', false);
        }
        if (!$session->has('products')) {
            $session->set('products', []);
        }

        if (!empty($products)) {
            $session->set('stockFaible', true);
            $session->set('products', $products);
        }
        
        return $this->render('layout/layout.html.twig');
    }

    
    public function stockFaible(ProduitsRepository $produitsRepository, Request $request)
    {
        $products = $produitsRepository->findStockFaible();
        
        $session = $request->getSession();
        if (!$session->has('stockFaible')) {
            $session->set('stockFaible', true);
            $session->set('products', []);
        }

        if (empty($products)) {
            $session->set('stockFaible', false);
            $session->set('products', $products);
        }

        return $this->render('layout/stockFaible.html.twig', [
            'products' => $products
        ]);
    }
}
