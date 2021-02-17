<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretEventController extends AbstractController
{
    /**
     * @Route("/secret-event", name="secret_event")
     */
    public function index(): Response
    {
        return $this->render('Front/secret_event/index.html.twig', [
            'controller_name' => 'SecretEventController',
        ]);
    }
}
