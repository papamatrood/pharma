<?php

namespace App\Controller;

use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\StockRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StockController extends AbstractController
{
    /**
     * @Route("/admin/stock/liste", name="stock_liste")
     */
    public function stockListe(StockRepository $stockRepository, Request $request)
    {
        if ($request->isMethod('GET') && ($request->query->get('recherche') != null)) {
            $recherche = new DateTime($request->query->get('recherche'));
        }else {
            $recherche = new DateTime('today');
        }

        $date = $recherche->format('Y-m-d');

        $stocks = $stockRepository->findAllWithDate($date);
        
        return $this->render('stock/stocksJour.html.twig', [
            'stocks' => $stocks,
            'recherche' => $recherche
        ]);
    }



    /**
     * @Route("/admin/stock/jour", name="stock_par_jour")
     */
    public function stockPDFParJour(StockRepository $stockRepository, Request $request)
    {

        if ($request->isMethod('GET') && ($request->query->get('jour') != null)) {
            $recherche = new DateTime($request->query->get('jour'));
        }else {
            $recherche = new DateTime('today');
        }

        $now = $recherche->format('Y-m-d');

        $stock = $stockRepository->findBy(['dateAt' => $now], ['dateAt' => 'DESC']);
        $html = $this->renderView('stock/stockPDF.html.twig', ['stock' => $stock, 'jour' => $now]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Stock ');
        $html2pdf->pdf->SetSubject('Stock DevAndClick');
        $html2pdf->pdf->SetKeywords('Stock,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('stock.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }



    /**
     * @Route("/admin/stock", name="stock")
     */
    public function stockPDF(StockRepository $stockRepository)
    {
        $date = new DateTime('now');
        $now = $date->format('Y-m-d');
        $stock = $stockRepository->findBy(['dateAt' => $now], ['dateAt' => 'DESC']);
        $html = $this->renderView('stock/stockPDF.html.twig', ['stock' => $stock, 'jour' => $now]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Stock ');
        $html2pdf->pdf->SetSubject('Stock DevAndClick');
        $html2pdf->pdf->SetKeywords('Stock,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('stock.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }
}
