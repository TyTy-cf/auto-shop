<?php

namespace App\Controller\Back;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Service\PostImageManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/admin/post")
 */
class PostController extends AbstractController
{

    private EntityManagerInterface $em;
    private PostImageManager $postImageManager;

    /**
     * PostController constructor.
     * @param EntityManagerInterface $em
     * @param PostImageManager $postImageManager
     */
    public function __construct(EntityManagerInterface $em, PostImageManager $postImageManager)
    {
        $this->em = $em;
        $this->postImageManager = $postImageManager;
    }

    /**
     * @Route("/", name="post_index", methods={"GET"})
     * @param PostRepository $postRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(
        PostRepository $postRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $qb = $postRepository->getAll();

        $posts = $paginator->paginate($qb, $request->query->get('page', 1));

        return $this->render('Back/crud/post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/new", name="post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCreatedAt(new DateTime());

            $this->postImageManager->addImage($form['image']->getData(), $post);

            $this->em->persist($post);
            $this->em->flush();
            return $this->redirectToRoute('post_index');
        }

        return $this->render('Back/crud/post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->postImageManager->addImage($form['image']->getData(), $post);
            $this->em->flush();

            //return $this->redirectToRoute('post_index');
        }

        return $this->render('Back/crud/post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_index');
    }


}
