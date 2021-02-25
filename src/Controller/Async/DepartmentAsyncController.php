<?php


namespace App\Controller\Async;


use App\Repository\AdministrativeAreaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentAsyncController extends AbstractController
{
    /**
     * @Route("/department/search", name="async_department_search")
     * @param Request $request
     * @param AdministrativeAreaRepository $areaRepository
     * @return Response
     */
    public function search(Request $request, AdministrativeAreaRepository $areaRepository): Response
    {
        $response = new Response();

//        if($this->getUser() === null) {
//            $response->setStatusCode(403);
//            return $response;
//        }

        $search = $request->get('search');

        $searchResultAa = $areaRepository->findByName($search);

        $data = [];

        foreach ($searchResultAa as $administrativeArea) {
            $data[] = [
                'id' => $administrativeArea->getId(),
                'name' => $administrativeArea->getName(),
            ];
        }

        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
