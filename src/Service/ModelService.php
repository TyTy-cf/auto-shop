<?php


namespace App\Service;


use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;

/**
 * Class ModelService.php
 *
 * @author Kevin Tourret
 */
class ModelService
{
    /**
     * @var CategoryRepository $categRepository
     */
    private CategoryRepository $categRepository;

    /**
     * @var BrandRepository $brandRepository
     */
    private BrandRepository $brandRepository;

    /**
     * ModelService constructor.
     * @param CategoryRepository $categRepository
     * @param BrandRepository $brandRepository
     */
    public function __construct(
        CategoryRepository $categRepository,
        BrandRepository $brandRepository
    ) {
        $this->categRepository = $categRepository;
        $this->brandRepository = $brandRepository;
    }

    private function getModels() {
        $arrayModel['Opel'] = [
            'Astra' => 'Citadine',
            'Corsa' => 'Citadine',
            'Zafira' => 'Monospace',
        ];
        $arrayModel['Audi'] = [
            'A5' => 'Berline',
            'Corsa' => 'Citadine',
            'Zafira' => 'Monospace',
        ];
        return $arrayModel;
    }

    /**
     * Appeler depuis la commande
     */
    public function createModels() {
        $arrayModels = $this->getModels();
        // itérer sur key/value => où la première key est la brand de la voiture (à récupérer via le repo)
        // itérer sur le deuxième tableau associatif (qui est la value du premier foreach)
        // où cette fois => la key est le nom du model et la value est la categorie de la voiture (à récupérer via le repo categ)
    }
}
