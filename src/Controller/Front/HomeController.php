<?php

namespace App\Controller\Front;

use App\Enum\AdminAreaTypeEnum;
use App\Repository\AdministrativeAreaRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PostRepository $postRepository
     * @param AdministrativeAreaRepository $areaRepository
     * @return Response
     */
    public function index(
        PostRepository $postRepository,
        AdministrativeAreaRepository $areaRepository
    ): Response
    {
//        if(null === $this->getUser()) {
//            return $this->redirectToRoute('app_login');
//        }

//        $this->denyAccessUnlessGranted('ROLE_USER');

        $posts = $postRepository->findLasts(3);

        $regions = $areaRepository->findBy([
            'type' => AdminAreaTypeEnum::REGIONS,
        ],
        [
            'name' => 'ASC'
        ]);

        $departments = $areaRepository->findBy([
            'type' => AdminAreaTypeEnum::DEPARTMENT,
        ],
            [
                'name' => 'ASC'
            ]);


        return $this->render('Front/home/index.html.twig', [
            'posts' => $posts,
            'regions' => $regions,
            'departments' => $departments,
        ]);
    }
}
