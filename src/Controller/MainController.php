<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/calendar", name="main_calendar")
     */
    public function index(EventRepository $calendar): Response
    {
        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */

        $user = $this->getUser();
        $events = $calendar->findByUser(['user' => $user]);
        $rdvs = [];

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getColorEvent(),

                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);
        // dd($data);
        return $this->render('main/index.html.twig', [
            compact('data'),

            'envents' => $events, 'user' => $user
        ]);
    }
}
