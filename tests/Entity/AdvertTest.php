<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:34
 */

namespace App\Tests\Entity;

use App\Entity\Advert;
use PHPUnit\Framework\TestCase;

class AdvertTest extends TestCase
{
    private $advert;

    public function setUp()
    {
        $this->advert = new Advert();
    }

    public function testUserIsInstanceOfUserClass()
    {
        $this->assertInstanceOf(Advert::class, $this->advert);
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->advert->getId());
    }

    public function testGetDate()
    {
        $this->advert->setDate(new \DateTime());
        $this->assertInstanceOf(\DateTime::class, $this->advert->getDate());
    }

    public function testGetTitle()
    {
        $this->advert->setTitle('Title');
        $this->assertSame('Title', $this->advert->getTitle());
    }

    public function testGetContent()
    {
        $this->advert->setContent('Content');
        $this->assertSame('Content', $this->advert->getContent());
    }

    public function testPublished()
    {
        $this->advert->setPublished(false);
        $this->assertSame(false, $this->advert->getPublished());
    }

    /*public function testGetAuthor()
    {
        $this->advert->setAuthor('author');
        $this->assertSame('author', $this->advert->getAuthor());
    }*/
}
