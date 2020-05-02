<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Category")
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

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categoryName
     *
     * @param string $categoryName
     *
     * @return Category
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Category
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}
