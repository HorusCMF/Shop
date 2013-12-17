<?php

namespace Horus\SiteBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 */
class Actions
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $token;

    /**
     * @MongoDB\String
     */
    protected $titre;

    /**
     * @MongoDB\Int
     */
    protected $aid;

    /**
     * @MongoDB\String
     */
    protected $content;

    /**
     * @MongoDB\Timestamp
     */
    protected $dateCreated;


    /**
     * Constructor
     */
    public function __construct(){
        $this->token = sha1($this->titre.$this->content);
        $this->dateCreated = time();
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
     * Set token
     *
     * @param string $token
     * @return self
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }


    /**
     * Get aid
     *
     * @return id $id
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Set aid
     *
     * @param string $id
     * @return self
     */
    public function setAid($id)
    {
        $this->aid = $id;
        return $this;
    }

    /**
     * Get token
     *
     * @return string $token
     */
    public function getToken()
    {
        return $this->token;
    }
    /**
     * Set token
     *
     * @param string $token
     * @return self
     */
    public function setTitre($token)
    {
        $this->titre = $token;
        return $this;
    }

    /**
     * Get token
     *
     * @return string $token
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get token
     *
     * @return string $token
     */
    public function getContent()
    {
        return $this->content;
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

}
