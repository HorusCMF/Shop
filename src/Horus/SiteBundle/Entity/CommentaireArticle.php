<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Commentaire
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\CommentaireRepository")
 * @ORM\Table(name="commentaires")
 * @ORM\HasLifecycleCallbacks()
 */
class CommentaireArticle
{

    /**
     * Constructor
     */
    public function __construct(){
        $this->dateCreated = new \Datetime('now');
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="commentaires")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;


    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="commentaires")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var integer
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;


    /**
     * @var integer
     * @ORM\Column(name="visible", type="integer", nullable=false)
     */
    private $visible;



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
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return CommentaireArticle
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return datetime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set content
     *
     * @param text $content
     * @return CommentaireArticle
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set visible
     *
     * @param integer $visible
     * @return CommentaireArticle
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * Get visible
     *
     * @return integer 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set article
     *
     * @param Horus\SiteBundle\Entity\Article $article
     * @return CommentaireArticle
     */
    public function setArticle(\Horus\SiteBundle\Entity\Article $article = null)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * Get article
     *
     * @return Horus\SiteBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     * @return CommentaireArticle
     */
    public function setClient(\Horus\SiteBundle\Entity\Client $client = null)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get client
     *
     * @return Horus\SiteBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
}