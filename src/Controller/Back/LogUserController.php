<?php

namespace App\Controller\Back;

use App\Entity\LogUser;
use App\Form\LogUserType;
use App\Repository\LogUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/log")
 */
class LogUserController extends AbstractController
{
    /**
     * @Route("/", name="log_user_index", methods={"GET"})
     */
    public function index(LogUserRepository $logUserRepository): Response
    {
        return $this->render('Back/crud/log_user/index.html.twig', [
            'log_users' => $logUserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="log_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $logUser = new LogUser();
        $form = $this->createForm(LogUserType::class, $logUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($logUser);
            $entityManager->flush();

            return $this->redirectToRoute('log_user_index');
        }

        return $this->render('Back/crud/log_user/new.html.twig', [
            'log_user' => $logUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_user_show", methods={"GET"})
     */
    public function show(LogUser $logUser): Response
    {
        return $this->render('Back/crud/log_user/show.html.twig', [
            'log_user' => $logUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="log_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LogUser $logUser): Response
    {
        $form = $this->createForm(LogUserType::class, $logUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('log_user_index');
        }

        return $this->render('Back/crud/log_user/edit.html.twig', [
            'log_user' => $logUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LogUser $logUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($logUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('log_user_index');
    }
}
