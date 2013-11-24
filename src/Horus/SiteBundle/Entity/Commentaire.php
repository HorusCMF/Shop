<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Commentaire
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\CommentaireRepository")
 * @ORM\Table(name="commentaire")
 * @ORM\HasLifecycleCallbacks()
 */
class Commentaire
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
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="commentaires")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;


    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="commentaires")
     * @ORM\JoinColumn(name="clients_id", referencedColumnName="id")
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
     * @return Commentaire
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
     * @return Commentaire
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
     * Set produit
     *
     * @param Horus\SiteBundle\Entity\Produit $produit
     * @return Commentaire
     */
    public function setProduit(\Horus\SiteBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;
        return $this;
    }

    /**
     * Get produit
     *
     * @return Horus\SiteBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     * @return Commentaire
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

    /**
     * Set visible
     *
     * @param integer $visible
     * @return Commentaire
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
}