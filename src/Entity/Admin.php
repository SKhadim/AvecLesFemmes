<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Trait\DateTimeTrait;
#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends AbstractMembre
{
    use DateTimeTrait;
}
