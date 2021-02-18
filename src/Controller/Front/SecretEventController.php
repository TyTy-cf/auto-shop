<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretEventController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
//        if(null === $this->getUser()) {
//            return $this->redirectToRoute('app_login');
//        }

//        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('Front/secret_event/index.html.twig', [
            'controller_name' => 'SecretEventController',
        ]);
    }
}
