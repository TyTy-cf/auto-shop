<?php


namespace App\Controller\Front\Accessibility;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessibilityDemoController extends AbstractController
{
    /**
     * @Route('/accessibility/demo', name="accessibility_demo")
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->render('Front/Accessibility/demo.html.twig');
    }
}
