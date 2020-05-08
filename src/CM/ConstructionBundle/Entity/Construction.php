<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="construction")
 */
class Construction
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * @ORM\Column(type="string", length=80, unique=true)
    */
    private $constructionName;

    /**
     * @ORM\Column(type="string",nullable=true)
    */
    private $description;

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
     * @ORM\Column(type="string", length=100, nullable=true)
    */
    private $note;

    /**
     * @ORM\Column(type="string", nullable=true, columnDefinition="enum('main', 'subpage', 'disabled')")
    */
    private $noteVisibility;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    public function setConstructionName($constructionName)
    {
        $this->constructionName = $constructionName;

        return $this;
    }

    public function getConstructionName()
    {
        return $this->constructionName;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
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

    public function setAuthor(\CM\AccessBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}
