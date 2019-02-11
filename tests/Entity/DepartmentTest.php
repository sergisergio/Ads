<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:24
 */

namespace App\Tests\Entity;


use App\Entity\Department;
use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    private $department;

    public function setUp()
    {
        $this->department = new Department();
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
}