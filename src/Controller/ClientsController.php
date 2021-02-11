<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientsType;
use App\Repository\ClientsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user/clients")
 */
class ClientsController extends AbstractController
{
    /**
     */
    public function index(ClientsRepository $clientsRepository): Response
    {
        return $this->render('clients/index.html.twig', [
            'clients' => $clientsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="clients_index")
     * @Route("/new", name="clients_new")
     * @Route("/{id}/edit", name="clients_edit")
     */
    public function new(Request $request, Clients $client = null): Response
    {
        if (is_null($client)) {
            $client = new Clients();
        }
        $entityManager = $this->getDoctrine()->getManager();
        $clients = $entityManager->getRepository(Clients::class)->findAll();
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('clients_index');
        }

        return $this->render('clients/new.html.twig', [
            'client' => $client,
            'clients' => $clients,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clients_show")
     */
    public function show(Clients $client): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Clients::class)->find($client);
        $numero = $client->getNumero();
        $prenomNom = $client->getPrenom(). ' ' . $client->getNom();
        $adresse = $client->getAdresse();
        $telephone = $client->getTelephone();
        $response = new JsonResponse();
        return $response->setData([
            'numero' => $numero,
            'prenomNom' => $prenomNom,
            'adresse' => $adresse,
            'telephone' => $telephone
        ]);
    }

    /**
     */
    public function edit(Request $request, Clients $client): Response
    {
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clients_index');
        }

        return $this->render('clients/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clients_delete", methods={"DELETE","POST"})
     */
    public function delete(Request $request, Clients $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clients_index');
    }
}
