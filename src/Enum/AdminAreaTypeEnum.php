<?php


namespace App\Enum;


use App\Utils\EnumManipulator;

class AdminAreaTypeEnum
{
    const REGIONS = 'region';
    const DEPARTMENT = 'department';
    const CITY = 'city';

    public static function getLabel($key): string
    {
        if($key === self::REGIONS) {
            return 'Région';
        } elseif ($key === self::DEPARTMENT) {
            return 'Département';
        } elseif ($key === self::CITY) {
            return 'Ville';
        }

        return 'Inconnu';
    }

    public static function getFormChoices(): array{
        $choices = [];
        $types = EnumManipulator::getEnumConstants(self::class);

        foreach ($types as $type) {
            $choices[self::getLabel($type)] = $type;
        }

        return $choices;
    }


}
