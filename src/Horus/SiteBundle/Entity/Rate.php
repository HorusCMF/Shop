<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Rate
 * @ORM\Entity
 * @ORM\Table(name="produit_rate")
 * @ORM\HasLifecycleCallbacks()
 */
class Rate
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @Assert\Url(message = "La note n'est pas valide")
     * @ORM\Column(name="rate", type="float", nullable=true)
     */
    private $rate;


    /**
     * @ORM\ManyToOne(targetEntity="Produit",inversedBy="seo")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    protected $produit;


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
     * Set rate
     *
     * @param float $rate
     * @return Rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set produit
     *
     * @param Horus\SiteBundle\Entity\Produit $produit
     * @return Rate
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
}