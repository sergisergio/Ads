<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 12/02/19
 * Time: 17:02
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/contact');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}