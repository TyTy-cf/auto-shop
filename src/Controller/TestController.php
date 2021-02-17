<?php


namespace App\Controller;


use App\Service\AdministrativeArea\AdminAreaImportService;
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
     * @param AdminAreaImportService $adminAreaImportService
     */
    public function testController(AdminAreaImportService $adminAreaImportService) {
//        $adminAreaImportService->importRegions();
        $adminAreaImportService->importDepartments();
    }

}
