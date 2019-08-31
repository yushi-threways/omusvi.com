<?php

namespace App\Security\Provider;

use App\Security\Manager\AdminManager;
use FOS\UserBundle\Security\UserProvider;

class AdminProvider extends UserProvider
{
    public function __construct(AdminManager $userManager)
    {
        parent::__construct($userManager);
    }
}