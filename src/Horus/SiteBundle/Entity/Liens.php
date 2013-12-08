<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Liens
 * @ORM\Entity
 * @ORM\Table(name="produit_liens")
 * @ORM\HasLifecycleCallbacks()
 */
class Liens
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
     * @Assert\Url(message = "Le lien n'est pas valide")
     * @ORM\Column(name="link", type="string", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(name="aliasing", type="string", nullable=true)
     */
    private $aliasing;


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
     * Set link
     *
     * @param string $link
     * @return Liens
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set aliasing
     *
     * @param string $aliasing
     * @return Liens
     */
    public function setAliasing($aliasing)
    {
        $this->aliasing = $aliasing;
        return $this;
    }

    /**
     * Get aliasing
     *
     * @return string 
     */
    public function getAliasing()
    {
        return $this->aliasing;
    }

    /**
     * Set produit
     *
     * @param Horus\SiteBundle\Entity\Produit $produit
     * @return Liens
     */
    public function setProduit(\Horus\SiteBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;
        $produit->addLien($this);
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