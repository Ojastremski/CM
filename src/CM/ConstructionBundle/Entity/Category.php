<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
    */
    private $categoryName;

    /**
     * @ORM\Column(type="boolean", options={"default":"1"})
    */
    private $active;

    
    public function getId()
    {
        return $this->id;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }
}
