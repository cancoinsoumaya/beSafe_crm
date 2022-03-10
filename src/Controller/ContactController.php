<?php

namespace App\Controller;

use App\Entity\CompanyContact;
use App\Entity\ContactType;
use App\Entity\IndevidualContact;
use App\Entity\User;
use App\Form\CompanyContactType;
use App\Form\IndevidualContactType;
use App\Form\SearchType;
use App\Repository\CompanyContactRepository;
use App\Repository\IndevidualContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/contact")
 * @IsGranted("ROLE_USER")
 */

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="app_contact")
     */
    public function index(Request $request, CompanyContactRepository $companyContactRepository, IndevidualContactRepository $indevidualContactRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */

        $user = $this->getUser();

        $contactTypeRepository = $entityManager->getRepository(ContactType::class);
        $contactTypes = $contactTypeRepository->findAll();
        $companyContacts = $companyContactRepository->findAll();
        $indevidualContacts =  $indevidualContactRepository->findAll();
        // dd($indevidualContact);

        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);

        //$donnees = $repo->findAll();
        $donnees = $companyContactRepository->findCompanyContact();

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $name = $searchForm->getData()->getName();
            $donnees = $companyContactRepository->search($name);
        }

        $companyContactsRe = $donnees;


        return $this->render('contact/index.html.twig', [
            'companyContactsRe' => $companyContactsRe,
            'indevidualContacts' => $indevidualContacts,

            'contactTypes' => $contactTypes,
            'user' => $user,
            'companyContacts' => $companyContacts,
            'current_menu' => 'recherche',
            'searchForm' => $searchForm->createView()


        ]);
    }
    /**
     * @Route("/company", name="contact_company", methods={"GET", "POST"})
     */
    public function newCampany(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */

        $user = $this->getUser();
        $post = $request->request;
        $companyContact = new CompanyContact();
        $form_company = $this->createForm(CompanyContactType::class, $companyContact);
        $form_company->handleRequest($request);

        if ($form_company->isSubmitted() && $form_company->isValid()) {

            $companyContact->setCreatedAt(new \DateTime());
            $entityManager->persist($companyContact);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau contact ajouter');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/companyContact/index.html.twig', [
            'companyContact' => $companyContact,
            'form_company' => $form_company->createView(),
            'user' => $user,
        ]);
    }
    /**
     * @Route("/indevidual", name="contact_individual", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */

        $user = $this->getUser();
        $IndevidualContact = new IndevidualContact();
        $form_Indevidual = $this->createForm(IndevidualContactType::class, $IndevidualContact);
        $form_Indevidual->handleRequest($request);


        $contactTypeRepository = $entityManager->getRepository(ContactType::class);
        $contactTypes = $contactTypeRepository->findAll();

        if ($form_Indevidual->isSubmitted() && $form_Indevidual->isValid()) {

            $IndevidualContact->setCreatedAt(new \DateTime());
            $entityManager->persist($IndevidualContact);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau contact ajouter');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/indevidualContact/index.html.twig', [
            'IndevidualContact' => $IndevidualContact,
            'form_individual' => $form_Indevidual->createView(),
            'user' => $user,
        ]);
    }
}
