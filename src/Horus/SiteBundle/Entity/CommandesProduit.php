<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * CommandesProduit
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\CommandesProduitRepository")
 * @ORM\Table(name="commandes_produit")
 * @ORM\HasLifecycleCallbacks()
 */
class CommandesProduit
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
     * @return CommandesProduit
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
     * @return CommandesProduit
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
     * Set produit
     *
     * @param Horus\SiteBundle\Entity\Produit $produit
     * @return CommandesProduit
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
     * @return CommandesProduit
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
     * Set totalTTC
     *
     * @param float $totalTTC
     * @return CommandesProduit
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
     * @return CommandesProduit
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
}