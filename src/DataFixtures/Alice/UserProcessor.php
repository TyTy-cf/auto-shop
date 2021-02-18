<?php

/*
 * This file is part of the drozevent-api package.
 *
 * (c) Benjamin Georgeault <https://www.drosalys-web.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures\Alice;

use App\Entity\User;
use Fidry\AliceDataFixtures\ProcessorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserProcessor
 *
 * @author Benjamin Georgeault
 */
class UserProcessor implements ProcessorInterface
{

    private UserPasswordEncoderInterface $encoder;

    /** @var string[] */
    private array $encodedPasswords;

    /**
     * UserProcessor constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->encodedPasswords = [];
    }

    /**
     * @inheritDoc
     */
    public function preProcess(string $id, $object): void
    {
        if (!$object instanceof User) {
            return;
        }

        if (null !== $password = $object->getPassword()) {
            $object->setPassword($this->encodePassword($password));
        }
    }

    /**
     * @inheritDoc
     */
    public function postProcess(string $id, $object): void
    {

    }

    /**
     * @param string $password
     * @return string
     */
    private function encodePassword(string $password): string
    {
        if (!array_key_exists($password, $this->encodedPasswords)) {
            $this->encodedPasswords[$password] = $this->encoder->encodePassword(new User(), $password);
        }

        return $this->encodedPasswords[$password];
    }
}
