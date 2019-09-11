<?php

namespace App\Tests\Controller\Admin;

use App\Entity\Admin;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Client;

abstract class AbstractControllerTest extends WebTestCase
{
    use FixturesTrait;

    /**
     * @var array
     */
    protected $fixtures;

    /**
     * @var array
     */
    protected $additionalFixtureFiles = [];

    /**
     * @var Admin
     */
    protected $admin1;

    public function setUp()
    {
        parent::setUp();
        $fixtureDir = __DIR__.'/../../fixtures';
        $this->fixtures = $this->loadFixtureFiles([
            $fixtureDir . '/admin.yaml',
        ]);
        $this->admin1 = $this->fixtures['admin1'];
    }

    protected function createLoginClient(): Client
    {
        $this->loginAs($this->admin1, 'admin');
        return $this->makeClient();
    }
    
    protected function createNoLoginClient(): Client
    {
        return static::createClient(['environment' => $this->environment]);
    }
}
