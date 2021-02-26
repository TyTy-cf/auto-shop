<?php

namespace App\Controller\Back;

use App\Entity\LogUser;
use App\Form\LogUserType;
use App\Repository\LogUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/log")
 */
class LogUserController extends AbstractController
{
    /**
     * @Route("/", name="log_user_index", methods={"GET"})
     * @param LogUserRepository $logUserRepository
     * @return Response
     */
    public function index(LogUserRepository $logUserRepository): Response
    {
        return $this->render('Back/crud/log_user/index.html.twig', [
            'log_users' => $logUserRepository->findBy([], ['logAt' => 'DESC']),
        ]);
    }
}
