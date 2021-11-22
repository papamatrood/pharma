<?php

namespace App\Controller;

use DateTime;
use App\Entity\Employes;
use App\Entity\Salaires;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\SalairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/salaires")
 */
class SalairesController extends AbstractController
{
    private $mois = [];

    public function __construct()
    {
        $this->mois = [
            'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Août',
            'Septembre',
            'Octobre',
            'Novembre',
            'Décembre'
        ];
    }

    /**
     * @Route("/", name="salaires")
     * @Route("/mois/{mois}", name="salaires_mois")
     */
    public function index(SalairesRepository $salairesRepository, ?string $mois = null)
    {
        $lesmois = [];
        foreach ($this->mois as $month) {
            $lesmois[] =  $month . ' ' . '2020';
        }

        $salaires = $salairesRepository->findAll();

        if (!is_null($mois)) {
            $salaires = $salairesRepository->findByMois($mois);
        }

        return $this->render('salaires/index.html.twig', [
            'salaires' => $salaires,
            'lesmois' => $lesmois
        ]);
    }

    /**
     * @Route("/mois-pdf/", name="salaries_pdf")
     */
    public function pdfSalaries()
    {
        $now = new DateTime();
        $month =  $this->mois[(int) $now->format('n') - 1];
        $annee = (int) $now->format('Y');
        $mois = $month . ' ' . $annee;

        $em = $this->getDoctrine()->getManager();

        $salaries = $em->getRepository(Salaires::class)->findBy(['mois' => $mois]);

        if (empty($salaries)) {
            return $this->render('salaires/salariesVide.html.twig', [
                'mois' => $mois
            ]);
        }

        $html = $this->renderView('salaires/salariesPDF.html.twig', ['salaries' => $salaries, 'mois' => $mois]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Salaries ');
        $html2pdf->pdf->SetSubject('Salaries DevAndClick');
        $html2pdf->pdf->SetKeywords('Salaries,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('salaries.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }

    /**
     * @Route("/individuel", name="salaires_new")
     */
    public function individuel(Request $request)
    {
        $now = new DateTime();
        $month =  $this->mois[(int) $now->format('n') - 1];
        $annee = (int) $now->format('Y');

        $entityManager = $this->getDoctrine()->getManager();
        $employes = $entityManager->getRepository(Employes::class)->findAll();

        if ($request->isMethod('GET') && $request->query->get('salaireNet') !=null) {
            $idEmploye = $request->query->get('Matricule');
            $employe = $entityManager->getRepository(Employes::class)->find($idEmploye);
            $nbreHeure = (int) $request->query->get('salaireNbreHeure');
            $base = (int) $request->query->get('salaireBase');
            $avantages = (int) $request->query->get('salaireAvantages');
            $taux = (float) $request->query->get('salaireTauxHoraire');
            $primes = (int) $request->query->get('salairePrimes');
            $brut = (int) $request->query->get('salaireBrut');
            $cotisation = (int) $request->query->get('salaireCotisation');
            $net = (int) $request->query->get('salaireNet');
            $mois = $month . ' ' . $annee;
            $salaire = new Salaires();
            $salaire->setEmploye($employe);
            $salaire->setNombreHeure($nbreHeure);
            $salaire->setTauxHoraire($taux);
            $salaire->setSalaireBase($base);
            $salaire->setPrime($primes);
            $salaire->setAvantage($avantages);
            $salaire->setSalaireBrut($brut);
            $salaire->setSalaireNet($net);
            $salaire->setCotisationSocial($cotisation);
            $salaire->setMois($mois);

            $entityManager->persist($salaire);
            $entityManager->flush();

            return $this->redirectToRoute('salaires');
        }
        return $this->render('salaires/new.html.twig', [
            'employes' => $employes,
            'month' => $month
        ]);
    }

    /**
     * @Route("/pdf/{id}", name="salaire_pdf")
     */
    public function pdf($id)
    {
        $em = $this->getDoctrine()->getManager();

        $salaire = $em->getRepository(Salaires::class)->find($id);

        $html = $this->renderView('salaires/salairePDF.html.twig', ['salaire' => $salaire]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Salaire ' . $salaire->getMois());
        $html2pdf->pdf->SetSubject('Salaire DevAndClick');
        $html2pdf->pdf->SetKeywords('Salaire,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('salaire.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }
}
