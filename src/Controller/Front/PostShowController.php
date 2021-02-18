<?php


namespace App\Controller\Front;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostShowController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="post_show", methods={"GET"})
     * @param Post $post
     * @return Response
     */
    public function __invoke(Post $post): Response
    {
        return $this->render('Front/post/post-show.html.twig', [
            'post' => $post,
        ]);
    }

}
