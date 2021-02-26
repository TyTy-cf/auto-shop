<?php


namespace App\EventListener;


use App\Entity\LogUser;
use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

/**
 * Class LogSubscriber
 * @package App\EventListener
 * @property EntityManagerInterface em
 * @property Security security
 */
class LogSubscriber implements EventSubscriber
{


    /**
     * LogSubscriber constructor.
     * @param EntityManagerInterface $em
     * @param Security $security
     */
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if(!$entity instanceof LogUser) {
            /** @var User $user */
            $user = $this->security->getUser();

            $log = (new LogUser())
                ->setUser($user)
                ->setLogAt(new \DateTime())
                ->setTargetEntity($entity->getId())
                ->setTargetEntityType($this->em->getMetadataFactory()->getMetadataFor(get_class($entity))->getName())
                ->setAction('new')
            ;

            $this->em->persist($log);
            $this->em->flush();
        }
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
    }
}


