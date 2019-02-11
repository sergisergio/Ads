<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 06/02/19
 * Time: 14:27
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->user->getId());
    }
}
