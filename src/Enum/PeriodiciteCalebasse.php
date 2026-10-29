<?php

namespace App\Enum;

enum PeriodiciteCalebasse: string {
    case HEBDOMADAIRE = 'hebdomadaire';
    case MENSUEL = 'mensuel';
    case PAR_QUINZAINE = 'par_quinzaine';

    public function label(): string {
        return match ($this) {
            self::HEBDOMADAIRE => "Hébdomadaire",
            self::MENSUEL => "Mensuel",
            self::PAR_QUINZAINE => "Par quinzaine",
        };
    }
}