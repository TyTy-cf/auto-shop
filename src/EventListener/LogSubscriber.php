<?php


namespace App\EventListener;


use App\Entity\LogUser;
use App\Entity\User;
use App\Enum\LogActionEnum;
use App\Service\LogUserManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

/**
 * Class LogSubscriber
 * @package App\EventListener
 * @property LogUserManager $logManager
 */
class LogSubscriber implements EventSubscriber
{


    /**
     * LogSubscriber constructor.
     * @param LogUserManager $logManager
     */
    public function __construct(LogUserManager $logManager)
    {
        $this->logManager = $logManager;
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
        $this->logManager->addLog($entity, LogActionEnum::PERSIST);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->logManager->addLog($entity, LogActionEnum::UPDATE);
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->logManager->addLog($entity, LogActionEnum::REMOVE);
    }
}


