<?php
namespace App\Security\Manager;

use App\Entity\Admin;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\Util\CanonicalFieldsUpdater;
use FOS\UserBundle\Util\PasswordUpdaterInterface;

class AdminManager extends UserManager
{
    public function __construct(
        PasswordUpdaterInterface $passwordUpdater,
        CanonicalFieldsUpdater $canonicalFieldsUpdater,
        ObjectManager $om
    ) {
        parent::__construct($passwordUpdater, $canonicalFieldsUpdater, $om, Admin::class);
    }
    
    /**
     * @return Admin
     */
    public function createUser()
    {
        return parent::createUser();
    }
}