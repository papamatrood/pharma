<?php

namespace App\Controller;

use App\Repository\EmployesRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateursController extends AbstractController
{
    /**
     * @Route("/admin/liste/utilisateurs", name="utilisateurs_index")
     */
    public function index(EmployesRepository $employesRepository): Response
    {
        return $this->render('utilisateurs/index.html.twig', [
            'employes' => $employesRepository->findAll(),
        ]);
    }


    /**
     * @Route("/admin/privileges", name="privileges")
     */
    public function privileges(UtilisateursRepository $utilisateursRepository, Request $request)
    {
        $roles = [
            "Personnel" => "ROLE_USER",
            "Pharmacien" => "ROLE_PHARMACIEN",
            "Administrateur" => "ROLE_ADMIN",
            "Super Administrateur" => "ROLE_SUPERADMIN",
            "DG" => "ROLE_DG",
        ];
        
        $utilisateurs = $utilisateursRepository->findAll();
        if ($request->isMethod('GET') && ($request->query->get('utilisateur') != null) && ($request->query->get('role') != null)) {
            $id = (int) $request->query->get('utilisateur');
            $role = $request->query->get('role');
            $utilisateur = $utilisateursRepository->find($id);
            $utilisateur->setRole($role);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $this->addFlash('success', 'Rôle modifié avec succès !');

            return $this->redirectToRoute('main');
        }
        
        return $this->render('utilisateurs/privileges.html.twig', [
            'utilisateurs' => $utilisateurs,
            'roles' => $roles,
        ]);
    }
}
