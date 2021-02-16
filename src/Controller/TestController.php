<?php


namespace App\Controller;


use App\Service\ModelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController.php
 *
 * @author Kevin Tourret
 */
class TestController extends AbstractController
{

    /**
     * @Route("/tester", name="test_controller")
     * @param ModelService $modelService
     */
    public function testController(ModelService $modelService) {
        $modelService->createModels();
    }

}
