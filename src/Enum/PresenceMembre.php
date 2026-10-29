<?php

namespace App\Enum;

enum PresenceMembre: string {
    case PRESENT = 'present';
    case ABSENT_AVEC_ENVOI = 'absent_avec_envoi';
    case ABSENT_SANS_PAIEMENT = 'absent_sans_paiement';   

    public function label(): string {
        return match ($this) {
            self::PRESENT => "Présent",
            self::ABSENT_AVEC_ENVOI => "Absent avec envoi",
            self::ABSENT_SANS_PAIEMENT => "Absent sans paiement",
        };
    }
}