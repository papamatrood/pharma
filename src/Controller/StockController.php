<?php

namespace App\Controller;

use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\StockRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StockController extends AbstractController
{
    /**
     * @Route("/admin/stock", name="stock")
     */
    public function stockPDF(StockRepository $stockRepository)
    {
        $date = new DateTime('now');
        $now = $date->format('Y-m-d');
        $stock = $stockRepository->findBy(['dateAt' => $now]);
        $html = $this->renderView('stock/stockPDF.html.twig', ['stock' => $stock]);
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
