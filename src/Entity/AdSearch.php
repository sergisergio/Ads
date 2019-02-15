<?php
/**
 * Created by PhpStorm.
 * User: wa81-15
 * Date: 15/02/19
 * Time: 10:48
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class AdSearch
{
    private $department;

    private $category;

    public function __construct()
    {
        $this->department = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}