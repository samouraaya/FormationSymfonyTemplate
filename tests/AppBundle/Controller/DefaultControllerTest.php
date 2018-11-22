<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals($client->getResponse()->getStatusCode(),302);

        $this->assertEquals(count(['Hello World', 123]), 2);
        $this->assertEquals(count(['Hello World']), 1);
    }
}
