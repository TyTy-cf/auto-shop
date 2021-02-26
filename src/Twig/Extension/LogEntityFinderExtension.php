<?php

namespace App\Twig\Extension;

use App\Entity\LogUser;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class LogEntityFinderExtension
 * @package App\Twig\Extension
 * @property EntityManagerInterface em
 */
class LogEntityFinderExtension extends AbstractExtension
{
    /**
     * LogEntityFinderExtension constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('find_entity', [$this, 'findEntity']),
        ];
    }

    public function findEntity(LogUser $log)
    {
        $entity =  $this->em->getRepository($log->getTargetEntityType())->find($log->getTargetEntity());

        if (null === $entity) {
            if($log->getDetails() !== null && count($log->getDetails()) > 0) {
                return $log->getDetails();
            } else {
                $removeLog = $this->em->getRepository(LogUser::class)->findRemoveActionLog($log);
                dump($removeLog);
                return $removeLog->getDetails();
            }


        }

        return $entity;
    }
}
