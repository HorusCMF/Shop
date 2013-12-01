<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Produit
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\CommandesRepository")
 * @ORM\Table(name="commandes")
 * @ORM\HasLifecycleCallbacks()
 */
class Commandes
{

    /**
     * Constructor
     */
    public function __construct(){
        $this->dateCreated = new \Datetime('now');
        $this->dateUpdated = new \Datetime('now');
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
     * @ORM\Column(name="reference", type="string", nullable=false)
     */
    private $reference;

    /**
     * @Assert\Length(
     *      min = "8",
     *      max = "1000",
     *      minMessage = "Votre contenu doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre contenu ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @Assert\Length(
     *      min = "8",
     *      max = "1000",
     *      minMessage = "Votre message doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre message ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var integer
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

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
     * @var integer
     * @ORM\Column(name="paiement", type="integer", nullable=false)
     */
    private $paiement;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="commandes")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var string
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="date_updated", type="datetime", nullable=true)
     */
    private $dateUpdated;

    /**
     * @ORM\ManyToOne(targetEntity="Transports", inversedBy="commandes")
     * @ORM\JoinColumn(name="transport_id", referencedColumnName="id")
     */
    private $transport;

    /**
     * @ORM\OneToMany(targetEntity="CommandesProduit", mappedBy="commandes")
     */
    private $commandesProduits;


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
     * Set reference
     *
     * @param string $reference
     * @return Commandes
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set content
     *
     * @param text $content
     * @return Commandes
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
     * Set message
     *
     * @param text $message
     * @return Commandes
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Commandes
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set paiement
     *
     * @param integer $paiement
     * @return Commandes
     */
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;
        return $this;
    }

    /**
     * Get paiement
     *
     * @return integer 
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Commandes
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
     * Set dateUpdated
     *
     * @param datetime $dateUpdated
     * @return Commandes
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return datetime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     * @return Commandes
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
     * Set transport
     *
     * @param Horus\SiteBundle\Entity\Transports $transport
     * @return Commandes
     */
    public function setTransport(\Horus\SiteBundle\Entity\Transports $transport = null)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * Get transport
     *
     * @return Horus\SiteBundle\Entity\Transports 
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set totalTTC
     *
     * @param float $totalTTC
     * @return Commandes
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
     * @return Commandes
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
     * Add commandesProduits
     *
     * @param Horus\SiteBundle\Entity\CommandesProduit $commandesProduit
     * @return Commandes
     */
    public function addCommandesProduit(\Horus\SiteBundle\Entity\CommandesProduit $commandesProduits)
    {
        $this->commandesProduits[] = $commandesProduits;
        return $this;
    }

    /**
     * Remove commandesProduits
     *
     * @param Horus\SiteBundle\Entity\CommandesProduit $commandesProduit
     */
    public function removeCommandesProduit(\Horus\SiteBundle\Entity\CommandesProduit $commandesProduits)
    {
        $this->commandesProduits->removeElement($commandesProduits);
    }

    /**
     * Get commandesProduits
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCommandesProduits()
    {
        return $this->commandesProduits;
    }
}