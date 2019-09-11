<?php

namespace App\Tests\Controller\Admin;

use App\Tests\Controller\Admin\AbstractControllerTest;

class MyEventControllerTest extends AbstractControllerTest
{
    
    public function testIndexWithNoLogin()
    {
        $client = $this->createNoLoginClient();
        $client->request('GET', '/admin/');
        self::assertResponseRedirects('http://localhost/admin/login', 302, 'it must redirect to login page');
    }

    public function testIndex()
    {
        $client = $this->createLoginClient();

        $client->request('GET', '/admin/');
        self::assertStatusCode(200, $client);
    }
}
