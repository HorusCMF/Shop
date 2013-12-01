<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Addresses
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\AddressesRepository")
 * @ORM\Table(name="adresses")
 * @ORM\HasLifecycleCallbacks()
 */
class Addresses
{

    public function __construct(){
        $this->dateCreated = new \Datetime('now');
        $this->nature = 1;
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
     * @ORM\Column(name="nature", type="string", nullable=true)
     */
    private $nature;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string", nullable=true)
     */
    private $adresse;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", nullable=true)
     */
    private $ville;

    /**
     * @var string
     * @ORM\Column(name="zipcode", type="string", nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;


    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="addresses")
     * @ORM\JoinTable(name="client_id")
     */
    private $client;

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
     * Set adresse
     *
     * @param string $adresse
     * @return Addresses
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Addresses
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Addresses
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set dateCreated
     *
     * @param string $dateCreated
     * @return Addresses
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return string 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Add client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     * @return Addresses
     */
    public function addClient(\Horus\SiteBundle\Entity\Client $client)
    {
        $this->client[] = $client;
        return $this;
    }

    /**
     * Remove client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     */
    public function removeClient(\Horus\SiteBundle\Entity\Client $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set nature
     *
     * @param string $nature
     * @return Addresses
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
        return $this;
    }

    /**
     * Get nature
     *
     * @return string 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set client
     *
     * @param Horus\SiteBundle\Entity\Client $client
     * @return Addresses
     */
    public function setClient(\Horus\SiteBundle\Entity\Client $client = null)
    {
        $this->client = $client;
        return $this;
    }
}