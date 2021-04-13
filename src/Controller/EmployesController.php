<?php

namespace App\Controller;

use DateTime;
use App\Entity\Employes;
use App\Form\EmployesType;
use App\Entity\Utilisateurs;
use Spipu\Html2Pdf\Html2Pdf;
use App\Form\RegistrationFormType;
use App\Repository\EmployesRepository;
use App\Security\UtilisateursAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/employes")
 */
class EmployesController extends AbstractController
{
    /**
     * @Route("/", name="employes_index")
     */
    public function index(EmployesRepository $employesRepository): Response
    {
        return $this->render('employes/index.html.twig', [
            'employes' => $employesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/pdf", name="employes_pdf")
     */
    public function pdf()
    {
        $em = $this->getDoctrine()->getManager();

        $employes = $em->getRepository(Employes::class)->findAll();

        $html = $this->renderView('employes/employesPDF.html.twig', ['employes' => $employes]);
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetAuthor('DevAndClick');
        $html2pdf->pdf->SetTitle('Employés ');
        $html2pdf->pdf->SetSubject('Employés DevAndClick');
        $html2pdf->pdf->SetKeywords('Employés,devandclick');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->output('employes.pdf');

        $response = new Response();
        $response->headers->set('content-type', 'application/pdf');

        return $response;
    }

    /**
     * @Route("/new", name="employes_new")
     */
    public function new(Request $request): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        //$form = $this->createForm(EmployesType::class, $employe);
        //$form->handleRequest($request);

        if ($request->isMethod('GET') && $request->query->get('salaireNet') !=null) {
            $matricule = $request->query->get('matricule');
            $prenom = $request->query->get('prenom');
            $nom = $request->query->get('nom');
            $dateNaissance = $request->query->get('dateNaissance');
            $lieuNaissance = $request->query->get('lieuNaissance');
            $adresse = $request->query->get('adresse');
            $nationalite = $request->query->get('nationalite');
            $civilite = $request->query->get('civilite');
            $dateEmbauche = $request->query->get('dateEmbauche');
            $fonction = $request->query->get('fonction');
            $telephone = $request->query->get('telephone');
            $email = $request->query->get('email');
            $categorie = $request->query->get('categorie');
            $amo = $request->query->get('amo');
            $typeContrat = $request->query->get('typeContrat');
            $dateContrat = $request->query->get('dateContrat');
            $situationFamiliale = $request->query->get('situationFamiliale');
            $nombreEnfant = $request->query->get('nombreEnfant');
            $base = (int) $request->query->get('salaireBase');
            $avantages = (int) $request->query->get('salaireAvantages');
            $primes = (int) $request->query->get('salairePrimes');
            $brut = (int) $request->query->get('salaireBrut');
            $net = (int) $request->query->get('salaireNet');
            
            $employe = new Employes();
            $employe->setMatricule($matricule);
            $employe->setNom($nom);
            $employe->setPrenom($prenom);
            $employe->setDateNaissanceAt(new DateTime($dateNaissance));
            $employe->setLieuNaissance($lieuNaissance);
            $employe->setAdresse($adresse);
            $employe->setNationalite($nationalite);
            $employe->setCivilite($civilite);
            $employe->setDateEmbaucheAt(new DateTime($dateEmbauche));
            $employe->setFonction($fonction);
            $employe->setTelephone($telephone);
            $employe->setEmail($email);
            $employe->setCategorie($categorie);
            $employe->setNumeroAssuranceMaladie($amo);
            $employe->setDateContratAt(new DateTime($dateContrat));
            $employe->setSituationFamiliale($situationFamiliale);
            $employe->setNombreEnfant($nombreEnfant);
            $employe->setTypeContrat($typeContrat);
            $employe->setSalaireBase($base);
            $employe->setPrime($primes);
            $employe->setAvantage($avantages);
            $employe->setSalaireBrut($brut);
            $employe->setSalaireNet($net);

            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employes_index');
        }

        return $this->render('employes/new.html.twig');
    }

    /**
     * @Route("/{id}/edit", name="employes_edit")
     */
    public function edit(Request $request, Employes $employe): Response
    {
        $situationFamiliales = ['Marié(e)', 'Célibataire'];
        $civilites = ['Monsieur', 'Madame', 'Mademoiselle'];
        $categories = ['Vaccataire', 'Permanent'];
        $typeContrats = ['Stage', 'CDD', 'CDI'];

        $entityManager = $this->getDoctrine()->getManager();

        if ($request->isMethod('GET') && $request->query->get('salaireNet') !=null) {
            $matricule = $request->query->get('matricule');
            $prenom = $request->query->get('prenom');
            $nom = $request->query->get('nom');
            $dateNaissance = $request->query->get('dateNaissance');
            $lieuNaissance = $request->query->get('lieuNaissance');
            $adresse = $request->query->get('adresse');
            $nationalite = $request->query->get('nationalite');
            $civilite = $request->query->get('civilite');
            $dateEmbauche = $request->query->get('dateEmbauche');
            $fonction = $request->query->get('fonction');
            $telephone = $request->query->get('telephone');
            $email = $request->query->get('email');
            $categorie = $request->query->get('categorie');
            $amo = $request->query->get('amo');
            $typeContrat = $request->query->get('typeContrat');
            $dateContrat = $request->query->get('dateContrat');
            $situationFamiliale = $request->query->get('situationFamiliale');
            $nombreEnfant = $request->query->get('nombreEnfant');
            $base = (int) $request->query->get('salaireBase');
            $avantages = (int) $request->query->get('salaireAvantages');
            $primes = (int) $request->query->get('salairePrimes');
            $brut = (int) $request->query->get('salaireBrut');
            $net = (int) $request->query->get('salaireNet');
            
            $employe = $entityManager->getRepository(Employes::class)->find($employe);

            $employe->setMatricule($matricule);
            $employe->setNom($nom);
            $employe->setPrenom($prenom);
            $employe->setDateNaissanceAt(new DateTime($dateNaissance));
            $employe->setLieuNaissance($lieuNaissance);
            $employe->setAdresse($adresse);
            $employe->setNationalite($nationalite);
            $employe->setCivilite($civilite);
            $employe->setDateEmbaucheAt(new DateTime($dateEmbauche));
            $employe->setFonction($fonction);
            $employe->setTelephone($telephone);
            $employe->setEmail($email);
            $employe->setCategorie($categorie);
            $employe->setNumeroAssuranceMaladie($amo);
            $employe->setDateContratAt(new DateTime($dateContrat));
            $employe->setSituationFamiliale($situationFamiliale);
            $employe->setNombreEnfant($nombreEnfant);
            $employe->setTypeContrat($typeContrat);
            $employe->setSalaireBase($base);
            $employe->setPrime($primes);
            $employe->setAvantage($avantages);
            $employe->setSalaireBrut($brut);
            $employe->setSalaireNet($net);

            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employes_index');
        }

        return $this->render('employes/edit.html.twig', [
            'employe' => $employe,
            'situationFamiliales' => $situationFamiliales,
            'civilites' => $civilites,
            'categories' => $categories,
            'typeContrats' => $typeContrats
        ]);
    }

    /**
     * @Route("/ajouter/utilisateur/{id}", name="add_utilisateur", methods={"GET|POSt"})
     */
    public function addUser(Employes $employe, Request$request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UtilisateursAuthenticator $authenticator)
    {
        $roles = [
            "Personnel" => "ROLE_USER",
            "Pharmacien" => "ROLE_PHARMACIEN",
            "Administrateur" => "ROLE_ADMIN",
            "Super Administrateur" => "ROLE_SUPERADMIN",
            "DG" => "ROLE_DG",
        ];

        $errors = [];
        
        if (!empty($_POST)) {
            if (empty($request->request->get('username')) || (strlen($request->request->get('username')) < 5) ) {
                $errors['username'] = "Le nom d'utilisateur doit être supérieur ou égale à 5";
            }

            if (empty($request->request->get('password')) || (strlen($request->request->get('password')) < 6)) {
                $errors['password'] = "Le mot de passe doit être supérieur ou égale à 6";
            }

            if (empty($request->request->get('confirmpassword')) || ($request->request->get('confirmpassword') != $request->request->get('password'))) {
                $errors['confirmpassword'] = "Les mots de passe ne correspondent pas.";
            }

            if (!empty($errors)) {
                return $this->render('employes/assignation.html.twig', ['employe' => $employe, 'errors' => $errors, 'roles' => $roles]);
                //return $this->redirectToRoute('add_utilisateur', ['id' => $employe->getId(), 'errors' => $errors]);
            }

            $username = htmlentities($request->request->get('username'));
            $password = htmlentities($request->request->get('password'));
            $role = htmlentities($request->request->get('role'));
            $user = new Utilisateurs();
            $user->setPassword($passwordEncoder->encodePassword($user, $password));
            $user->setNomUtilisateur($username);
            $user->setEmail($employe->getEmail());
            $user->setRole($role);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $employe->setUtilisateur($user);
            $entityManager->persist($employe);

            $entityManager->flush();

            $this->addFlash('success', 'Un rôle a été assigné à l\'utilisateur avec succès !');

            return $this->redirectToRoute('utilisateurs_index');
        }
        return $this->render('employes/assignation.html.twig', ['employe' => $employe, 'errors' => $errors, 'roles' => $roles]);
    }

    /**
     * @Route("/edit/pass/{id}", name="edit_password")
     */
    public function editUser(Employes $employe, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UtilisateursAuthenticator $authenticator)
    {
        $roles = [
            "Personnel" => "ROLE_USER",
            "Pharmacien" => "ROLE_PHARMACIEN",
            "Administrateur" => "ROLE_ADMIN",
            "Super Administrateur" => "ROLE_SUPERADMIN",
            "DG" => "ROLE_DG",
        ];

        $errors = [];

        if (!empty($_POST)) {
            if (empty($request->request->get('username')) || (strlen($request->request->get('username')) < 5)) {
                $errors['username'] = "Le nom d'utilisateur doit être supérieur ou égale à 5";
            }

            if (empty($request->request->get('password')) || (strlen($request->request->get('password')) < 6)) {
                $errors['password'] = "Le mot de passe doit être supérieur ou égale à 6";
            }

            if (empty($request->request->get('confirmpassword')) || ($request->request->get('confirmpassword') != $request->request->get('password'))) {
                $errors['confirmpassword'] = "Les mots de passe ne correspondent pas.";
            }

            if (!empty($errors)) {
                return $this->render('employes/assignation.html.twig', ['employe' => $employe, 'errors' => $errors, 'roles' => $roles]);
            }

            $username = htmlentities($request->request->get('username'));
            $password = htmlentities($request->request->get('password'));
            $role = htmlentities($request->request->get('role'));
            $user = $employe->getUtilisateur();
            $user->setPassword($passwordEncoder->encodePassword($user, $password));
            $user->setNomUtilisateur($username);
            $user->setEmail($employe->getEmail());
            $user->setRole($role);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $employe->setUtilisateur($user);
            $entityManager->persist($employe);

            $entityManager->flush();

            $this->addFlash('success', 'Le mot de passe de l\'utilisateur a été modifié avec succès !');
        }
        return $this->render('employes/editPassword.html.twig', ['employe' => $employe, 'errors' => $errors, 'roles' => $roles]);
    }

    /**
     * @Route("/{id}", name="employes_show")
     */
    public function show(Employes $employe)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $employe = $entityManager->getRepository(Employes::class)->find($employe);
        $nomPrenom = $employe->getPrenom() . ' ' . $employe->getNom();
        $naissance = $employe->getDateNaissanceAt()->format('d/m/Y');
        $enfants = $employe->getNombreEnfant();
        $contrat = $employe->getTypeContrat();
        $categorie = $employe->getCategorie();
        $civilite = $employe->getCivilite();
        $fonction = $employe->getFonction();
        $embauche = $employe->getDateEmbaucheAt()->format('d/m/Y');
        $situation = $employe->getSituationFamiliale();
        $avantage = $employe->getAvantage();
        $prime = $employe->getPrime();
        $salaireBase = $employe->getSalaireBase();
        $salaireBrut = $employe->getSalaireBrut();
        $salaireNet = $employe->getSalaireNet();
        $response = new JsonResponse();
        return $response->setData([
            'employe' => $nomPrenom,
            'naissance' => $naissance,
            'enfants' => $enfants,
            'contrat' => $contrat,
            'categorie' => $categorie,
            'civilite' => $civilite,
            'fonction' => $fonction,
            'embauche' => $embauche,
            'situation' => $situation,
            'avantage' => $avantage,
            'prime' => $prime,
            'salaireBase' => $salaireBase,
            'salaireBrut' => $salaireBrut,
            'salaireNet' => $salaireNet,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="employes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employes $employe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employes_index');
    }
}
