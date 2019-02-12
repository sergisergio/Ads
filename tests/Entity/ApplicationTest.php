<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:32
 */

namespace App\Tests\Entity;

use App\Entity\Advert;
use App\Entity\Application;
use App\Entity\Category;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    private $application;
    private $user;
    private $advert;

    public function setUp()
    {
        $this->application = new Application();
        $this->user = new User();
        $this->advert = new Advert();
    }

    public function testUserIsInstanceOfUserClass()
    {
        $this->assertInstanceOf(Application::class, $this->application);
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->application->getId());
    }

    public function testGetContent()
    {
        $this->application->setContent('Content');
        $this->assertSame('Content', $this->application->getContent());
    }

    /*public function testGetAuthor()
    {
        $this->application->setAuthor($this->user);
        $this->assertSame($this->user, $this->user->getUsername());
    }*/

    public function testGetAdvert()
    {
        $this->application->setAdvert($this->advert);
        $this->assertSame($this->advert, $this->application->getAdvert());
    }


}
