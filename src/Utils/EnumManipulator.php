<?php

/*
 * This file is part of the drozevent-api package.
 *
 * (c) Benjamin Georgeault <https://www.drosalys-web.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

/**
 * Class EnumManipulator
 *
 * @author Benjamin Georgeault
 */
abstract class EnumManipulator
{
    /**
     * @var \ReflectionClass[]
     */
    private static $refs = [];

    /**
     * @param string $enumClass
     * @return array
     * @throws \ReflectionException
     */
    public static function getEnumConstants(string $enumClass): array
    {
        return self::getReflectionClass($enumClass)->getConstants();
    }

    /**
     * @param string $enumClass
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    private static function getReflectionClass(string $enumClass): \ReflectionClass
    {
        if (!array_key_exists($enumClass, self::$refs)) {
            self::$refs[$enumClass] = new \ReflectionClass($enumClass);
        }

        return self::$refs[$enumClass];
    }
}
