<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:50
 */

namespace App\Tests\Controller;

use App\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /**
     * Test page de login
     */
    public function testLoginPage()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Test logoutCheck
     */
    public function testLogout()
    {
        $securityController = new SecurityController();
        static::assertNull($securityController->logout());
    }
}
