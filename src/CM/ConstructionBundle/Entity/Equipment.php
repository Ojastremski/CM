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
     * @ORM\Column(type="string", length=20, nullable=true)
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
     * @ORM\Column(type="string", length=80, options={"default":"not_used"}, nullable=false)
    */
    private $target = "not_used";

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
     * Set equipmentCategory
     *
     * @param string $equipmentCategory
     *
     * @return Equipment
     */
    public function setEquipmentCategory($equipmentCategory)
    {
        $this->equipmentCategory = $equipmentCategory;

        return $this;
    }

    /**
     * Get equipmentCategory
     *
     * @return string
     */
    public function getEquipmentCategory()
    {
        return $this->equipmentCategory;
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
     * Set target
     *
     * @param string $target
     *
     * @return Equipment
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
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
}
