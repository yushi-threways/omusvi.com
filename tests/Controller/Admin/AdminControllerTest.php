<?php

namespace App\Tests\Controller\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use App\Tests\Controller\Admin\AbstractControllerTest;

class AdminController extends WebTestCase

{
    public function testNotLoginRedirect()
    {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/admin');
        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Submit')->form();
        $crawler = $client->submit($form);

        // We should get a validation error for the empty fields.
        $this->assertStatusCode(200, $client);
        $this->assertValidationErrors(['data.email', 'data.message'], $client->getContainer());

        // Try again with with the fields filled out.
        $form = $crawler->selectButton('Submit')->form();
        $form->setValues(['contact[email]' => 'nobody@example.com', 'contact[message]' => 'Hello']);
        $client->submit($form);
        $this->assertStatusCode(302, $client);
    }


}