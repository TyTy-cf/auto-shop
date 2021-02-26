<?php


namespace App\Service;


use App\Entity\LogUser;
use App\Entity\User;
use App\Enum\LogActionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/***
 * Class LogUserManager
 * @package App\Service
 * @property EntityManagerInterface em
 * @property Security security
 */
class LogUserManager
{


    /**
     * LogUserManager constructor.
     * @param EntityManagerInterface $em
     * @param Security $security
     */
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @param $target
     * @param string $actionKey
     */
    public function addLog($target, string $actionKey): void
    {
        if(!$target instanceof LogUser) {
            /** @var User $user */
            $user = $this->security->getUser();

            if($user !== null) {
                $log = (new LogUser())
                    ->setUser($user)
                    ->setLogAt(new \DateTime())
                    ->setTargetEntity($target->getId())
                    ->setTargetEntityType($this->em->getMetadataFactory()->getMetadataFor(get_class($target))->getName())
                    ->setAction($actionKey)
                ;

                if($actionKey === LogActionEnum::REMOVE) {
                    $this->onRemove($target, $log);
                }

                $this->em->persist($log);
                $this->em->flush();
            }
        }
    }

    private function onRemove($target, LogUser $log): void
    {
        $details = [
          'targetEntityType'=> $log->getTargetEntityType(),
          'targetEntityId' => $log->getTargetEntity(),
          'targetEntityName' => $target->__toString(),
        ];

        $log->setDetails($details);
    }
}
