<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretEventController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository): Response
    {
//        if(null === $this->getUser()) {
//            return $this->redirectToRoute('app_login');
//        }

//        $this->denyAccessUnlessGranted('ROLE_USER');

        $posts = $postRepository->findLasts(3);

        return $this->render('Front/secret_event/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
