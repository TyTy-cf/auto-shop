<?php

namespace App\Controller\Back;

use App\Entity\AdministrativeArea;
use App\Form\AdministrativeAreaType;
use App\Repository\AdministrativeAreaRepository;
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
     */
    public function index(AdministrativeAreaRepository $administrativeAreaRepository): Response
    {
        return $this->render('Back/crud/administrative_area/index.html.twig', [
            'administrative_areas' => $administrativeAreaRepository->findAll(),
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
