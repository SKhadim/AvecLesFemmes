<?php

namespace App\Enum;

enum FonctionMembre: string
{
    case MEMBRE_SIMPLE = 'MEMBRE_SIMPLE';
    case SECRETAIRE = 'SECRETAIRE';
    case RESPONSABLE = 'RESPONSABLE';

     public function getLibelle(): string
    {
        return match ($this) {
            self::MEMBRE_SIMPLE => 'Membre simple',
            self::SECRETAIRE => 'Secrétaire',
            self::RESPONSABLE => 'Responsable',
        };
    }
}