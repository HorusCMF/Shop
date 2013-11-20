<?php

namespace Hetic\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaylineCard
 *
 * @ORM\Table(name="payline_card")
 * @ORM\Entity
 */
class PaylineCard
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_card", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCard;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=12, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="contract", type="string", length=12, nullable=true)
     */
    private $contract;

    /**
     * @var integer
     *
     * @ORM\Column(name="primary", type="integer", nullable=true)
     */
    private $primary;

    /**
     * @var integer
     *
     * @ORM\Column(name="secondary", type="integer", nullable=true)
     */
    private $secondary;



    /**
     * Get idCard
     *
     * @return integer 
     */
    public function getIdCard()
    {
        return $this->idCard;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return PaylineCard
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contract
     *
     * @param string $contract
     * @return PaylineCard
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
    
        return $this;
    }

    /**
     * Get contract
     *
     * @return string 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set primary
     *
     * @param integer $primary
     * @return PaylineCard
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    
        return $this;
    }

    /**
     * Get primary
     *
     * @return integer 
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * Set secondary
     *
     * @param integer $secondary
     * @return PaylineCard
     */
    public function setSecondary($secondary)
    {
        $this->secondary = $secondary;
    
        return $this;
    }

    /**
     * Get secondary
     *
     * @return integer 
     */
    public function getSecondary()
    {
        return $this->secondary;
    }
}