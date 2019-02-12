<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 12/02/19
 * Time: 17:04
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdvertControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/adverts');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}