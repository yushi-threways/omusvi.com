<?php

namespace App\Service\MyEventApplication\Factory;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class MyEventApplicationFactory
 * @package App\Service\MyEventApplication
 */
abstract class MyEventApplicationFactory
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract public function create();
}
