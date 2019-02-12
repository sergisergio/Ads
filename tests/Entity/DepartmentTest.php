<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:24
 */

namespace App\Tests\Entity;

use App\Entity\Advert;
use App\Entity\Department;
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    private $department;
    private $advert;

    public function setUp()
    {
        $this->department = new Department();
        $this->advert = new Advert();
    }

    public function testUserIsInstanceOfUserClass()
    {
        $this->assertInstanceOf(Department::class, $this->department);
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->department->getId());
    }

    public function testGetName()
    {
        $this->department->setName('Paris');
        $this->assertSame('Paris', $this->department->getName());
    }

    public function testAddAdvert()
    {
        $this->department->addAdvert($this->advert);
        $this->assertCount(1, $this->department->getAdverts());
    }

    public function testRemoveAdvert()
    {
        $this->department->removeAdvert($this->advert);
        $this->assertCount(0, $this->department->getAdverts());
        $this->advert->setDepartment(null);
    }
}
