<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaylineWalletUsers
 * @ORM\Table(name="payline_wallet_users")
 * @ORM\Entity
 */
class PaylineWalletUsers
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
     * @var integer
     *
     * @ORM\Column(name="id_customer", type="integer", nullable=true)
     */
    private $idCustomer;

    /**
     * @var string
     *
     * @ORM\Column(name="id_wallet", type="string", length=30, nullable=true)
     */
    private $idWallet;



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
     * Set idCustomer
     *
     * @param integer $idCustomer
     * @return PaylineWalletUsers
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;
    
        return $this;
    }

    /**
     * Get idCustomer
     *
     * @return integer 
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * Set idWallet
     *
     * @param string $idWallet
     * @return PaylineWalletUsers
     */
    public function setIdWallet($idWallet)
    {
        $this->idWallet = $idWallet;
    
        return $this;
    }

    /**
     * Get idWallet
     *
     * @return string 
     */
    public function getIdWallet()
    {
        return $this->idWallet;
    }
}