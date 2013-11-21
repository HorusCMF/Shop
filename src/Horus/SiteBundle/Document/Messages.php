<?php

namespace Horus\SiteBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 */
class Messages
{

    /**
     * @MongoDB\Id
     */
    protected $id;


    /**
     * @MongoDB\String
     */
    protected $title;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\String
     */
    protected $dateCreated;


    /**
     * @MongoDB\ReferenceOne(targetDocument="Messages")
     */
    protected $parent;


    /**
     *
     */
    public function __construct(){
        $this->token = sha1(time());
        $this->dateCreated = new \Datetime('now');
        $this->dateCreated = $this->dateCreated->format('d/m/y H:i:s');
    }



    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreated
     *
     * @param string $dateCreated
     * @return self
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return string $dateCreated
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }


    /**
     * Set parent
     *
     * @param Horus\SiteBundle\Document\Messages $parent
     * @return self
     */
    public function setParent(\Horus\SiteBundle\Document\Messages $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Horus\SiteBundle\Document\Messages $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get parent
     *
     * @return Horus\SiteBundle\Document\Messages $parent
     */
    public function __toString()
    {
        return $this->title;
    }
}
