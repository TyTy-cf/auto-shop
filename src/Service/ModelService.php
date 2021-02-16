<?php


namespace App\Service;


use App\Entity\Model;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ModelService.php
 *
 * @author Marine Bertin
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
     * @var EntityManagerInterface $em
     */
    private EntityManagerInterface $em;

    /**
     * ModelService constructor.
     * @param CategoryRepository $categRepository
     * @param BrandRepository $brandRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(
        CategoryRepository $categRepository,
        BrandRepository $brandRepository,
        EntityManagerInterface $em
    ) {
        $this->categRepository = $categRepository;
        $this->brandRepository = $brandRepository;
        $this->em = $em;
    }

    /**
     * @return array
     */
    private function getModels(): array
    {
        $arrayModel['Opel'] = [
            'Astra' => 'Citadine',
            'Corsa' => 'Citadine',
            'Zafira' => 'Monospace',
            'Meriva' => 'Monospace',
            'Optimus Prime' => '4x4',
        ];
        $arrayModel['Audi'] = [
            'A5' => 'Berline',
            'Batmobile' => 'Tank',
            'Bumbo' => 'Mini',
            'A3' => 'Berline',
            'R8' => 'Coupée',
        ];
        $arrayModel['Ford'] = [
            'Falcon' => 'Mad Max',
            'Gran Torino' => 'Starsky et Hutch',
            'KITT' => 'K2000',
        ];
        $arrayModel['WackyRaces'] = [
            'Démone Double-Zero Grand Sport' => 'Citadine',
            'Caraverne' => 'Break',
            'Dingo-Limousine' => 'SUV',
            'Auto-aero-fuseau-planeur' => 'Pick up',
            'Bolide Ecarlate' => 'Pick up',
            'Compact PussyCat' => 'Citadine',
            'Tocard Tank' => 'Break',
            'Turbo Terrific' => 'Berline',
            'Tacot Tout-Terrain' => 'Berline'
        ];
        $arrayModel['Renault'] = [
            'Clio' => 'Citadine',
            'Kangoo' => 'Utilitaire',
            'Scenic' => 'Monospace',
            'Twingo' => 'Citadine',
        ];
        $arrayModel['CTR'] = [
            'Trikee' => 'Kart',
            'Retro Prime' => 'Kart',
            'Yellow Horde' => 'Kart',
            'Crikey' => 'Kart',
            'Imperium' => 'Kart',
            'The Deadinator' => 'Kart',
            'Futurosity' => 'Kart',
            'Probulot 2000' => 'Kart',
            'Harm Aid' => 'Kart',
            'Bad Girl' => 'Kart',
            'The Ruckus' => 'Kart',
            'Le Chaux' => 'Kart',
            'The Guzzler' => 'Kart',
            'Overcompensator' => 'Kart',
            'Bone Machine' => 'Kart',
            'Colostomator' => 'Kart',
            'Nostalginator' => 'Kart',
            'Bandibuggy' => 'Kart',
            'Fairy Mobile' => 'Kart',
            'Organ Grinder' => 'Kart',
            'Tweenage Wasteland' => 'Kart',
            'Angsterator' => 'Kart',
            'Slave Driver' => 'Kart',
            'Extreme Surplus' => 'Kart',
            'Junkulon Prime' => 'Kart',
            'Doom Buggy' => 'Kart',
            'Zwergauto' => 'Kart',
            'Der Pickle' => 'Kart',
            'Pressurizer' => 'Kart',
            'Toy Block Car' => 'Kart',
            'CRster' => 'Kart'
        ];
        $arrayModel['Volkswagen'] = [
            'Touran' => 'Monospace',
            'Tiguan' => 'SUV',
            'Polo' => 'Polyvalente',
            'Golf' => 'Compacte',
            'Coccinelle' => 'Compacte',
            'Passat' => 'Familiale routière'
        ];
        $arrayModel['Toyota'] = [
            'Yaris' => 'Polyvalente',
            'Aygo' => 'Mini citadine',
            'Prius' => 'Hybride',
            'Supra' => 'Grand tourisme'
        ];
        $arrayModel['Ferrari'] = [
            'Roma' => 'Coupée Sport',
            '488' => 'Coupée Sport',
            'Tributo' => 'Coupée Sport',
            'T8 Spider' => 'Coupée Sport',
            'Monza' => 'Coupée Sport',
            'Stradale' => 'Coupée Sport',
        ];
        $arrayModel['Nissan'] = [
            'GT-R' => 'Supercar',
            'Qashqai' => 'Crossover',
            'Juke' => 'Crossover urbain',
            'Leaf' => 'Compacte'
        ];
        $arrayModel['Mercedes'] = [
            'Classe A' => 'Berline',
            'Classe C' => 'Berline',
            'Classe E' => 'Berline',
            'Classe S' => 'Berline',
            'Classe S Limousine' => 'Berline',
            'Mercedes-Maybach Classe S' => 'Berline',
            'EQA' => 'SUV',
            'Classe B' => 'Monospace',
            'Classe V' => 'Monospace',
        ];
        return $arrayModel;
    }

    /**
     * @return int
     */
    public function getModelsSize(): int
    {
        return sizeof($this->getModels());
    }

    /**
     * Appeler depuis la commande
     */
    public function createModels() {
        // On itère sur notre tableau de K,V
        // Où la K = nom de la marque
        // Où la V = tableau de K,V entre nom du modèle et de la catégorie
        foreach ($this->getModels() as $brandName=> $arrayInfosModels) {
            // On itère sur notre tableau de K,V
            // Où la K = nom du modèle
            // Où la V = nom de la catégorie
            foreach ($arrayInfosModels as $modelName => $categoryName) {
                // On peut donc récupérer en BDD nos catégories et nos marques respestives en fonction
                // des données de notre tableau
                $category = $this->categRepository->findOneBy(['name' => $categoryName]);
                $brand = $this->brandRepository->findOneBy(['name' => $brandName]);
                // Afin de pouvoir créer nos Model
                $model = (new Model())
                    ->setName($modelName)
                    ->setBrand($brand)
                    ->setCategory($category)
                ;
                $this->em->persist($model);
            }
        }
        $this->em->flush();
    }
}
