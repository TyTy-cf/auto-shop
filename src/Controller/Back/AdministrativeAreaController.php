<?php

namespace App\Controller\Back;

use App\Entity\AdministrativeArea;
use App\Form\AdministrativeAreaType;
use App\Form\Filters\AdminAreaFilterType;
use App\Repository\AdministrativeAreaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdaterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/administrative-area")
 */
class AdministrativeAreaController extends AbstractController
{
    /**
     * @Route("/", name="administrative_area_index", methods={"GET"})
     * @param AdministrativeAreaRepository $administrativeAreaRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param FilterBuilderUpdaterInterface $builderUpdater
     * @return Response
     */
    public function index(
        AdministrativeAreaRepository $administrativeAreaRepository,
        PaginatorInterface $paginator,
        Request $request,
        FilterBuilderUpdaterInterface $builderUpdater
    ): Response
    {

        $qb = $administrativeAreaRepository->getAll();

        $filters = $this->createForm(AdminAreaFilterType::class, null, [
            'method' => 'GET',
        ]);

        if($request->query->has($filters->getName())) {
            $filters->submit($request->query->get($filters->getName()));
            $builderUpdater->addFilterConditions($filters, $qb);
        }

        $pagination = $paginator->paginate($qb, $request->query->get('page', 1));

        return $this->render('Back/crud/administrative_area/index.html.twig', [
            'administrative_areas' => $pagination,
            'filters' => $filters->createView(),
        ]);
    }

    /**
     * @Route("/new", name="administrative_area_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $administrativeArea = new AdministrativeArea();
        $form = $this->createForm(AdministrativeAreaType::class, $administrativeArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($administrativeArea);
            $entityManager->flush();

            return $this->redirectToRoute('administrative_area_index');
        }

        return $this->render('Back/crud/administrative_area/new.html.twig', [
            'administrative_area' => $administrativeArea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administrative_area_show", methods={"GET"})
     */
    public function show(AdministrativeArea $administrativeArea): Response
    {
        return $this->render('Back/crud/administrative_area/show.html.twig', [
            'administrative_area' => $administrativeArea,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="administrative_area_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdministrativeArea $administrativeArea): Response
    {
        $form = $this->createForm(AdministrativeAreaType::class, $administrativeArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administrative_area_index');
        }

        return $this->render('Back/crud/administrative_area/edit.html.twig', [
            'administrative_area' => $administrativeArea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administrative_area_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AdministrativeArea $administrativeArea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$administrativeArea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($administrativeArea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrative_area_index');
    }
}
