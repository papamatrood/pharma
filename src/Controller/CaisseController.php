<?php

namespace App\Controller;

use DateTime;
use App\Entity\Caisse;
use App\Form\CaisseType;
use Spipu\Html2Pdf\Html2Pdf;
use App\Repository\CaisseRepository;
use App\Repository\VentesRepository;
use App\Repository\CommandesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/caisse")
 */
class CaisseController extends AbstractController
{
    private $mois = [];
    private $caisseRepo;

    public function __construct(CaisseRepository $caisseRepository)
    {
        $this->caisseRepo = $caisseRepository;

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
     * @Route("/", name="caisse_liste")
     * @Route("/mois/{mois}", name="caisse_mois")
     */
    public function index(VentesRepository $ventesRepository, CommandesRepository $livraisonRepository,Request $request, ?string $mois = null): Response
    {

        $anneeSearch = (new DateTime())->format('Y');
        
        if (is_null($mois)) {
            $mois = (new DateTime())->format('m');
        }else {
            $anneeSearch = explode('-', $mois)[1];
            $mois = explode('-', $mois)[2];
        }
        $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
        
        if ($request->isMethod('GET') && ($request->query->get('anneeSearch') != null)) {
            $anneeSearch = $request->query->get('anneeSearch');
        }

        $date = $anneeSearch . '-' . $mois;

        
        $annee = (int) (new DateTime())->format('Y');
        $anneeSituation = [];
        for ($i=4; $i >= 0 ; $i--) { 
            $anneeSituation[] = $annee - $i;
        }
        
        
        $months = [];
        foreach ($this->mois as $month) {
            $months[] =  $month . '-' . $anneeSearch;
        }
        /* Approvisionnements */
        $approvisionnements = [];
        $approvisionnements['total'] = 0;
        $caissesApprovisionnement = $this->caisseRepo->findApprovisionnement(['Dépôt', 'don'], $date);

        foreach ($caissesApprovisionnement as $value ) {
            $approvisionnements['ligne'][] = [
                'id' => $value->getId(),
                'motif' => $value->getMotif(),
                'montant' => $value->getEntre(),
                'date' => $value->getDateAt()
            ];
            $approvisionnements['total'] += $value->getEntre();
        }
        
        $ventes = $ventesRepository->findByMonth($date);
        
        foreach ($ventes as $vente ) {
            $total = 0;
            foreach ($vente->getProduits()['produits'] as $montant) {
                $total += $montant['net'];
            }
            $approvisionnements['ligne'][] = [
                'id' => $vente->getId(),
                'motif' => 'Vente N° : ' . $vente->getReference(),
                'montant' => $total,
                'date' => $vente->getDateVenteAt()
            ];
            $approvisionnements['total'] += $total;
        }

        /* Dépense */
        $depenses = [];
        $depenses['total'] = 0;
        $caissesDepenses = $this->caisseRepo->findDepense(['Livraison:'], $date);

        foreach ($caissesDepenses as $valueDepense ) {
            $depenses['ligne'][] = [
                'id' => $valueDepense->getId(),
                'motif' => $valueDepense->getMotif(),
                'montant' => $valueDepense->getSortie(),
                'date' => $valueDepense->getDateAt()
            ];
            $depenses['total'] += $valueDepense->getSortie();
        }
        
        $livraisons = $livraisonRepository->findByMonth($date);
        
        foreach ($livraisons as $livraison ) {
            $total = 0;
            foreach ($livraison->getProduits()['produits'] as $montant) {
                $total += ($montant['quantite'] * $montant['prix']);
            }
            $depenses['ligne'][] = [
                'id' => $livraison->getId(),
                'motif' => 'Livraison N° : ' . $livraison->getReference(),
                'montant' => $total,
                'date' => $livraison->getDateCommandeAt()
            ];
            $depenses['total'] += $total;
        }
        
        return $this->render('caisse/index.html.twig', [
            'approvisionnements' => $approvisionnements,
            'depenses' => $depenses,
            'months' => $months,
            'anneeSituation' => array_reverse($anneeSituation),
            'selected' => $anneeSearch
        ]);
    }

    /**
     * @Route("/situation/", name="caisse_pdf")
     */
    public function situation(CaisseRepository $caisseRepository): Response
    {
        $caisses = $caisseRepository->findAll();
        $html = $this->renderView('caisse/caissesPDF.html.twig', ['caisses' => array_reverse($caisses)]);
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
     * @Route("/approvisionnement", name="caisse_approvisionnement")
     */
    public function approvisionnement(Request $request): Response
    {
        $caisse = new Caisse();
        $form = $this->createForm(CaisseType::class, $caisse);
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
            $now = $date->format('Y-m-d');
            $caisse->setDateAt($now);
            
            $entityManager->persist($caisse);
            $entityManager->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('caisse/approvisionnement.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/depense", name="caisse_depense")
     */
    public function depense(Request $request): Response
    {
        $caisse = new Caisse();

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
            $now = $date->format('Y-m-d');
            $caisse->setDateAt($now);

            $entityManager->persist($caisse);
            $entityManager->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('caisse/depense.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
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
