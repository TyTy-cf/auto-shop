<?php


namespace App\Service\AdministrativeArea;


use App\Entity\AdministrativeArea;
use App\Enum\AdminAreaTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AdminAreaImportService
{

    private HttpClientInterface $client;
    private EntityManagerInterface $em;


    /**
     * AdminAreaImportService constructor.
     * @param HttpClientInterface $client
     * @param EntityManagerInterface $em
     */
    public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    public function importRegion()
    {
        $response = $this->client->request(
            'GET',
            'https://geo.api.gouv.fr/regions',
//            [
//                'query' => [
//                    'nom' => 'Hauts-de-France',
//                ],
//            ]
        );

        if($response->getStatusCode() === 200) {
            $results = $response->toArray();

            if(count($results) > 0) {
                foreach ($results as $region) {
                    $entity = new AdministrativeArea();
                    $entity->setName($region['nom']);
                    $entity->setCode($region['code']);
                    $entity->setType(AdminAreaTypeEnum::REGIONS);
                    $this->createIfNotExist($entity);
                }

                $this->em->flush();
            }
        }
    }

    public function createIfNotExist(AdministrativeArea $administrativeArea)
    {
        $repo = $this->em->getRepository(AdministrativeArea::class);

        $match = $repo->findBy([
            'code' => $administrativeArea->getCode(),
            'type' => $administrativeArea->getType(),
        ]);

        if(count($match) === 0) {
            $this->em->persist($administrativeArea);
        }
    }
}
