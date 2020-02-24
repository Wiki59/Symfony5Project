<?php

namespace App\Manager;

use App\Entity\Country;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CountryManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function import(array $list)
    {
        foreach ($list as $libele) {
            $country = new Country();
            $country->setLibele($libele);
            $this->entityManager->persist($country);
        }

        $this->entityManager->flush();
    }
}