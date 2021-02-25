<?php


namespace App\Controller\Async;


use App\Entity\Post;
use App\Repository\PostRepository;
use App\Service\PostImageManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PostHtmlAsyncController extends AbstractController
{
    /**
     * @Route("/more-post", name="async_post_html_collection")
     * @param Request $request
     * @param PostRepository $postRepository
     * @param PostImageManager $imageManager
     * @param PaginatorInterface $paginator
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function collectionAction(
        Request $request,
        PostRepository $postRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $qb = $postRepository->getLasts();

        $posts = $paginator->paginate($qb, $request->query->get('page', 1), 3);

        return $this->render('Front/Partials/Async/Post/post-card-loop.html.twig', [
            'posts' => $posts,
        ]);
    }
}
