<?php


namespace App\Controller\Async;


use App\Entity\Post;
use App\Repository\PostRepository;
use App\Service\PostImageManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PostAsyncController
{
    /**
     * @Route("/post", name="async_post_collection")
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
        PostImageManager $imageManager,
        PaginatorInterface $paginator,
        SerializerInterface $serializer
    ): Response
    {
        $response = new Response();
        $qb = $postRepository->getLasts();

        $posts = $paginator->paginate($qb, $request->query->get('page', 1), 2);

        $data = [];

        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

//        $data = $serializer->serialize($posts, 'json');
//        $response->setContent($data);


        foreach ($posts as $post) {
            /** @var Post $post */
            $postData = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'excerpt' => $post->getExcerpt(),
                'createdAt' => $post->getCreatedAt(),
            ];

            if($post->getThumbnail() !== null) {
                $postData['thumbnail'] = $baseurl . $imageManager->getImagePath($post);
                dump($postData['thumbnail']);
            }

            $data[] = $postData;
        }

        $response->setContent(json_encode($data, JSON_UNESCAPED_SLASHES));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
