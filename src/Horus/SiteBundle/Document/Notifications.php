<?php

namespace Horus\SiteBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 */
class Notifications
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $action;

    /**
     * @MongoDB\String
     */
    protected $token;

    /**
     * @MongoDB\String
     */
    protected $titre;

    /**
     * @MongoDB\String
     */
    protected $content;

    /**
     * @MongoDB\String
     */
    protected $datas;

    /**
     * @MongoDB\String
     */
    protected $dateCreated;


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
     * Set datas
     *
     * @param string $datas
     * @return self
     */
    public function setDatas($datas)
    {
        $this->datas = serialize($datas);
        return $this;
    }

    /**
     * Get datas
     *
     * @return string $datas
     */
    public function getDatas()
    {
        return $this->datas;
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
     * Set action
     *
     * @param int $action
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get action
     *
     * @return int $action
     */
    public function getAction()
    {
        return $this->action;
    }
}
