<?php

namespace CM\ConstructionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CM\ConstructionBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Construction")
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
     * @ORM\Column(type="datetime")
    */
    private $modifiedAt;

    /**
     * @ORM\Column(type="integer")
    */
    private $author;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
    */
    private $note;

    /**
     * @ORM\Column(type="string", length=100, columnDefinition="enum('main', 'subpage', 'disabled')")
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

    /**
     * Set constructionName
     *
     * @param string $constructionName
     *
     * @return Construction
     */
    public function setConstructionName($constructionName)
    {
        $this->constructionName = $constructionName;

        return $this;
    }

    /**
     * Get constructionName
     *
     * @return string
     */
    public function getConstructionName()
    {
        return $this->constructionName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Construction
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Construction
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
     * @return Construction
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
     * Set author
     *
     * @param integer $author
     *
     * @return Construction
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return integer
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Construction
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
     * @return Construction
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
}
