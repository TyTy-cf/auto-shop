<?php


namespace App\Controller\Back;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeBackController extends AbstractController
{
    /**
     * @Route("/admin")
     */
    public function __invoke()
    {
        return $this->redirectToRoute('post_index');
    }
}
