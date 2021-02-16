<?php


namespace App\Service;


use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;

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
            'Turbo Terrific' => 'Berlines',
            'Tacot Tout-Terrain' => 'Berlines'
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
            'Classe A' => 'Berlines',
            'Classe C' => 'Berlines',
            'Classe E' => 'Berlines',
            'Classe S' => 'Berlines',
            'Classe S Limousine' => 'Berlines',
            'Mercedes-Maybach Classe S' => 'Berlines',
            'EQA' => 'SUV',
            'GLA' => 'SUV',
            'GLB' => 'SUV',
            'GLC' => 'SUV',
            'EQC' => 'SUV',
            'GLE' => 'SUV',
            'GLS' => 'SUV',
            'Classe B' => 'Monospace',
            'Classe V' => 'Monospace',
            'EQV' => 'Monospace',
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
        $arrayModels = $this->getModels();
        // itérer sur key/value => où la première key est la brand de la voiture (à récupérer via le repo)
        // itérer sur le deuxième tableau associatif (qui est la value du premier foreach)
        // où cette fois => la key est le nom du model et la value est la categorie de la voiture (à récupérer via le repo categ)
    }
}
