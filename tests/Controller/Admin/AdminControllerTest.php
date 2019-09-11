<?php

namespace App\Tests\Controller\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class AdminControllerTest extends WebTestCase
{
    use FixturesTrait;

    public function setUp()
    {
        parent::setUp();
        $fixtureDir = __DIR__.'/../../fixtures';
        $this->fixtures = $this->loadFixtureFiles([
            $fixtureDir . '/admin.yaml',
        ]);
    }

    public function testLoginFail()
    {
        $client = $this->makeClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', '/admin/login');
        $this->assertStatusCode(200, $client);
        $form = $crawler->selectButton('送信')->form();
        $form['admin_login[username]'] = '_';
        $form['admin_login[password]'] = '_';
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals('/admin/login', $client->getRequest()->getPathInfo());
    }

    public function testLoginSuccess()
    {
        $client = $this->makeClient();
        $client->followRedirects(true);
        $client->getKernel()->boot();
        $crawler = $client->request('GET', '/admin/login');
        $this->assertStatusCode(200, $client);
        $form = $crawler->selectButton('送信')->form();
        $form['admin_login[username]'] = 'admin1';
        $form['admin_login[password]'] = 1234;
        $client->submit($form);
        $this->assertStatusCode(200, $client);
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals('/', $client->getRequest()->getPathInfo());
    }
}
