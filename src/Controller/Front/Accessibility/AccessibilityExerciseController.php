<?php


namespace App\Controller\Front\Accessibility;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessibilityExerciseController extends AbstractController
{
    /**
     * @Route("/accessibility/exercice", name="accessibility_exercise")
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->render('Front/Accessibility/exercise.html.twig');
    }
}
