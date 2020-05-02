<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Equipment")
 */
class Equipment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, nullable=false)
    */
    private $equipmentName;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
    */
    private $equipmentCategory;

    /**
     * @ORM\Column(type="string", length=30, nullable=false)
    */
    private $equipmentSerialNumber;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
    */
    private $note;

    /**
     * @ORM\Column(type="string", nullable=true, columnDefinition="enum('main', 'subpage', 'disabled')")
    */
    private $noteVisibility;

    /**
     * @ORM\Column(type="datetime")
    */
    private $publishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
    */
    private $modifiedAt;

    /**
     * @ORM\ManyToOne(targetEntity="CM\AccessBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
    */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Construction", fetch="EAGER")
     * @ORM\JoinColumn(name="construction_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
    */
    private $target;

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
     * Set equipmentName
     *
     * @param string $equipmentName
     *
     * @return Equipment
     */
    public function setEquipmentName($equipmentName)
    {
        $this->equipmentName = $equipmentName;

        return $this;
    }

    /**
     * Get equipmentName
     *
     * @return string
     */
    public function getEquipmentName()
    {
        return $this->equipmentName;
    }

    /**
     * Set equipmentSerialNumber
     *
     * @param string $equipmentSerialNumber
     *
     * @return Equipment
     */
    public function setEquipmentSerialNumber($equipmentSerialNumber)
    {
        $this->equipmentSerialNumber = $equipmentSerialNumber;

        return $this;
    }

    /**
     * Get equipmentSerialNumber
     *
     * @return string
     */
    public function getEquipmentSerialNumber()
    {
        return $this->equipmentSerialNumber;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Equipment
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set noteVisibility
     *
     * @param string $noteVisibility
     *
     * @return Equipment
     */
    public function setNoteVisibility($noteVisibility)
    {
        $this->noteVisibility = $noteVisibility;

        return $this;
    }

    /**
     * Get noteVisibility
     *
     * @return string
     */
    public function getNoteVisibility()
    {
        return $this->noteVisibility;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Equipment
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return Equipment
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set equipmentCategory
     *
     * @param \CM\ConstructionBundle\Entity\Category $equipmentCategory
     *
     * @return Equipment
     */
    public function setEquipmentCategory(\CM\ConstructionBundle\Entity\Category $equipmentCategory = null)
    {
        $this->equipmentCategory = $equipmentCategory;

        return $this;
    }

    /**
     * Get equipmentCategory
     *
     * @return \CM\ConstructionBundle\Entity\Category
     */
    public function getEquipmentCategory()
    {
        return $this->equipmentCategory;
    }

    /**
     * Set author
     *
     * @param \CM\AccessBundle\Entity\User $author
     *
     * @return Equipment
     */
    public function setAuthor(\CM\AccessBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \CM\AccessBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set target
     *
     * @param \CM\ConstructionBundle\Entity\Construction $target
     *
     * @return Equipment
     */
    public function setTarget(\CM\ConstructionBundle\Entity\Construction $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \CM\ConstructionBundle\Entity\Construction
     */
    public function getTarget()
    {
        return $this->target;
    }
}
