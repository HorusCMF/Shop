<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Horus\SiteBundle\Util\Box;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Tag
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\TagRepository")
 * @ORM\Table(name="tag")
 * @ORM\HasLifecycleCallbacks()
 */
class Tag
{

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
     * @Assert\NotBlank(
     *     message = "Le mot ne doit pas etre vide"
     * )
     * @ORM\Column(name="word", type="string", length=200, nullable=true)
     */
    private $word;


    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="tags")
     */
    private $articles;


    /**
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="tags")
     */
    private $produits;


    public function __toString(){
        return Box::limit_words($this->word);
    }

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
     * Set word
     *
     * @param string $word
     * @return Tag
     */
    public function setWord($word)
    {
        $this->word = $word;
    
        return $this;
    }

    /**
     * Get word
     *
     * @return string 
     */
    public function getWord()
    {
        return $this->word;
    }


    /**
     * Add articles
     *
     * @param \Horus\SiteBundle\Entity\Article $articles
     * @return Tag
     */
    public function addArticle(\Horus\SiteBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
    
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Horus\SiteBundle\Entity\Article $articles
     */
    public function removeArticle(\Horus\SiteBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add produits
     *
     * @param Horus\SiteBundle\Entity\Produit $produits
     * @return Tag
     */
    public function addProduit(\Horus\SiteBundle\Entity\Produit $produits)
    {
        $this->produits[] = $produits;
        return $this;
    }

    /**
     * Remove produits
     *
     * @param Horus\SiteBundle\Entity\Produit $produits
     */
    public function removeProduit(\Horus\SiteBundle\Entity\Produit $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Tag
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
}