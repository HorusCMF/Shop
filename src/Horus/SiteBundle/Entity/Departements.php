<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Villes
 * @ORM\Table(name="departements")
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\DepartementsRepository")
 */
class Departements
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name_province", type="string", nullable=true)
     */
    private $nameProvince;

    /**
     * @var string
     *
     * @ORM\Column(name="name_province_uppercase", type="string", nullable=true)
     */
    private $nameProvinceUppercase;

    /**
     * @var string
     *
     * @ORM\Column(name="province_slug", type="string", nullable=true)
     */
    private $provinceSlug;


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
     * Set code
     *
     * @param string $code
     * @return Departements
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nameProvince
     *
     * @param string $nameProvince
     * @return Departements
     */
    public function setNameProvince($nameProvince)
    {
        $this->nameProvince = $nameProvince;
        return $this;
    }

    /**
     * Get nameProvince
     *
     * @return string 
     */
    public function getNameProvince()
    {
        return $this->nameProvince;
    }

    /**
     * Set nameProvinceUppercase
     *
     * @param string $nameProvinceUppercase
     * @return Departements
     */
    public function setNameProvinceUppercase($nameProvinceUppercase)
    {
        $this->nameProvinceUppercase = $nameProvinceUppercase;
        return $this;
    }

    /**
     * Get nameProvinceUppercase
     *
     * @return string 
     */
    public function getNameProvinceUppercase()
    {
        return $this->nameProvinceUppercase;
    }

    /**
     * Set provinceSlug
     *
     * @param string $provinceSlug
     * @return Departements
     */
    public function setProvinceSlug($provinceSlug)
    {
        $this->provinceSlug = $provinceSlug;
        return $this;
    }

    /**
     * Get provinceSlug
     *
     * @return string 
     */
    public function getProvinceSlug()
    {
        return $this->provinceSlug;
    }

    /**
     * Get Name Province
     * @return string
     */
    public function __toString(){
        return $this->getNameProvince();
    }
}