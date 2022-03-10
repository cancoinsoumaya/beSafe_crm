<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{


    /**
     * @Route("/new", name="profil_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */

            $uploadedFile = $form['picture']->getData();

            dd($uploadedFile);
            $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
            $newFilename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newFilename
            );
            $user->setPicture($newFilename);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="profil_show", methods={"GET"})
     */
    public function show(User $user): Response
    {

        return $this->render('profil/show.html.twig', [
            'user' => $user,

        ]);
    }

    /**
     * @Route("/{id}/edit", name="profil_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */

            $uploadedFile = $form['img']->getData();

            $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
            $newFilename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newFilename
            );
            $user->setPicture($newFilename);

            $entityManager->flush();

            return $this->redirectToRoute('profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="profil_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profil_index', [], Response::HTTP_SEE_OTHER);
    }
}
