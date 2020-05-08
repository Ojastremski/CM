<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="history")
 */
class History
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Equipment", mappedBy="histories", fetch="EAGER")
     */
    private $equipments;

    /**
     * @ORM\Column(type="string", length=1024, nullable=false)
    */
    private $message;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
    */
    private $recipient;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
    */
    private $owner;

    /**
     * @ORM\Column(type="datetime")
    */
    private $date;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
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

    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function addEquipment(Equipment $equipment)
    {
        $this->equipments[] = $equipment;

        return $this;
    }

    public function removeEquipment(Equipment $equipment)
    {
        $this->equipments->removeElement($equipment);
    }
    
    public function getEquipments()
    {
        return $this->equipments;
    }
}
