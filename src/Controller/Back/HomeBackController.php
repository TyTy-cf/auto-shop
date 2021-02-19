<?php


namespace App\Controller\Back;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeBackController extends AbstractController
{
    /**
     * @Route("/admin")
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->redirectToRoute('post_index');
    }
}
