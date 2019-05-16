<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase
{
    public function testIndex()
    {

        $client = static::createClient();

        $client->request('GET', '/aichiadm/tag/new/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        // $form = $crawler->selectButton('submit')->form();

        // // set some values
        // $form['name'] = 'tag';
        // $form['tag[name]'] = 'テスト';
        // $form['tag[slug]'] = 'test';
        
        // // submit the form
        // $crawler = $client->submit($form);        
    }
}
