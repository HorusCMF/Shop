<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Produit
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\CommandesProduitRepository")
 * @ORM\Table(name="cart")
 * @ORM\HasLifecycleCallbacks()
 */
class Cart
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
     * @var integer
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="commandes")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="Commandes", inversedBy="commandesProduits")
     * @ORM\JoinColumn(name="commandes_id", referencedColumnName="id")
     */
    private $commandes;


    /**
     * @ORM\OneToOne(targetEntity="Client", inversedBy="cart")
     * @ORM\JoinColumn(name="clients_id", referencedColumnName="id")
     */
    private $client;


    /**
     * @var integer
     * @ORM\Column(name="totalTTC", type="float", nullable=false)
     */
    private $totalTTC;

    /**
     * @var integer
     * @ORM\Column(name="totalHT", type="float", nullable=false)
     */
    private $totalHT;


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
     * Set quantity
     *
     * @param integer $quantity
     * @return Cart
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Cart
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
     * Set totalTTC
     *
     * @param float $totalTTC
     * @return Cart
     */
    public function setTotalTTC($totalTTC)
    {
        $this->totalTTC = $totalTTC;
        return $this;
    }

    /**
     * Get totalTTC
     *
     * @return float 
     */
    public function getTotalTTC()
    {
        return $this->totalTTC;
    }

    /**
     * Set totalHT
     *
     * @param float $totalHT
     * @return Cart
     */
    public function setTotalHT($totalHT)
    {
        $this->totalHT = $totalHT;
        return $this;
    }

    /**
     * Get totalHT
     *
     * @return float 
     */
    public function getTotalHT()
    {
        return $this->totalHT;
    }

    /**
     * Set produit
     *
     * @param Horus\SiteBundle\Entity\Produit $produit
     * @return Cart
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
     * Set commandes
     *
     * @param Horus\SiteBundle\Entity\Commandes $commandes
     * @return Cart
     */
    public function setCommandes(\Horus\SiteBundle\Entity\Commandes $commandes = null)
    {
        $this->commandes = $commandes;
        return $this;
    }

    /**
     * Get commandes
     *
     * @return Horus\SiteBundle\Entity\Commandes 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Set client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     * @return Cart
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