<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:34
 */

namespace App\Tests\Entity;

use App\Entity\Advert;
use App\Entity\Application;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class AdvertTest extends TestCase
{
    private $advert;
    private $application;
    private $category;

    public function setUp()
    {
        $this->advert = new Advert();
        $this->application = new Application();
        $this->category = new Category();
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

    public function TestAddApplication()
    {
        $this->advert->addApplication($this->application);
        $this->assertCount(1, $this->advert->getApplications());
    }

    public function testRemoveApplication()
    {
        $this->advert->removeApplication($this->application);
        $this->assertCount(0, $this->advert->getApplications());
    }

    public function testAddCategory()
    {
        $this->advert->addCategory($this->category);
        $this->assertCount(1, $this->advert->getCategories());
    }

    public function testRemoveCategory()
    {
        $this->advert->removeCategory($this->category);
        $this->assertCount(0, $this->advert->getCategories());
    }
}
