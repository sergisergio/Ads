<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 11/02/19
 * Time: 14:30
 */

namespace App\Tests\Entity;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private $category;

    public function setUp()
    {
        $this->category = new Category();
    }

    public function testUserIsInstanceOfUserClass()
    {
        $this->assertInstanceOf(Category::class, $this->category);
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->category->getId());
    }

    public function testGetName()
    {
        $this->category->setName('Paris');
        $this->assertSame('Paris', $this->category->getName());
    }
}
