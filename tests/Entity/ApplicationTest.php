<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:32
 */

namespace App\Tests\Entity;


use App\Entity\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    private $application;

    public function setUp()
    {
        $this->application = new Application();
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
}