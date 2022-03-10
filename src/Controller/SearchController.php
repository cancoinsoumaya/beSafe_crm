<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\CompanyContactRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     * @param Request $request
     * @param companyContactRepository $repo

     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, CompanyContactRepository $repo)
    {

        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);

        //$donnees = $repo->findAll();
        $donnees = $repo->findCompanyContact();

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $name = $searchForm->getData()->getName();
            $donnees = $repo->search($name);
        }

        $companyContacts = $donnees;
        return $this->render('search/index.html.twig', [
            'companyContacts' => $companyContacts,
            'current_menu' => 'recherche',
            'searchForm' => $searchForm->createView()
        ]);
    }
}
