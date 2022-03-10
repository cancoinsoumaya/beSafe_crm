<?php

namespace App\Controller;

use Symfony\Bundle\MakerBundle\EventRegistry;


use App\Repository\CompanyContactRepository;
use App\Repository\EventRepository;
use App\Repository\IndevidualContactRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard_index")
     * * @IsGranted("ROLE_USER")
     * Response
     */
    public function index(Request $request, UserRepository $userRepository, EventRepository $eventRepository, CompanyContactRepository $companyContactRepository, IndevidualContactRepository $indevidualContactRepository, EntityManagerInterface $entityManager): Response
    {
        //  the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */

        $user = $this->getUser();

        $companyContacts = $companyContactRepository->findByUser(['user' => $user]);
        $events = $eventRepository->findByUser(['user' => $user]);
        $users = $userRepository->findByEvents(['events' => $events]);

        // dd($companyContacts);
        return $this->render('dashboard/index.html.twig', [
            'companyContacts' => $companyContacts,
            'events' => $events,
            'user' => $user,
            'users' => $users,


        ]);
    }
}
