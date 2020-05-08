<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="equipment")
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
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
    */
    private $equipmentCategory;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
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
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
    */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Construction", fetch="EAGER")
     * @ORM\JoinColumn(name="construction_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
    */
    private $target;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
    */
    private $recipient;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
    */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity="History", inversedBy="equipments", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinTable(name="equipment_history")
    */
    private $histories;

    /**
     * @ORM\Column(type="datetime", nullable=true)
    */
    private $assignmentDate;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->histories = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEquipmentName($equipmentName)
    {
        $this->equipmentName = $equipmentName;

        return $this;
    }

    public function getEquipmentName()
    {
        return $this->equipmentName;
    }

    public function setEquipmentSerialNumber($equipmentSerialNumber)
    {
        $this->equipmentSerialNumber = $equipmentSerialNumber;

        return $this;
    }

    public function getEquipmentSerialNumber()
    {
        return $this->equipmentSerialNumber;
    }

    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNoteVisibility($noteVisibility)
    {
        $this->noteVisibility = $noteVisibility;

        return $this;
    }

    public function getNoteVisibility()
    {
        return $this->noteVisibility;
    }

    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function setAssignmentDate($assignmentDate)
    {
        $this->assignmentDate = $assignmentDate;

        return $this;
    }

    public function getAssignmentDate()
    {
        return $this->assignmentDate;
    }

    public function setEquipmentCategory(Category $equipmentCategory = null)
    {
        $this->equipmentCategory = $equipmentCategory;

        return $this;
    }

    public function getEquipmentCategory()
    {
        return $this->equipmentCategory;
    }

    public function setAuthor(\CM\AccessBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setTarget(Construction $target = null)
    {
        $this->target = $target;

        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function addHistory(History $history)
    {
        $this->histories[] = $history;

        return $this;
    }

    public function removeHistory(History $history)
    {
        $this->histories->removeElement($history);
    }

    public function getHistories()
    {
        return $this->histories;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }
}
