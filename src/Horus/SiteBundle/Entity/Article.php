<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Horus\SiteBundle\Util\Box;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Article
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\ArticleRepository")
 * @ORM\Table(name="article")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{

    public function __construct(){
        $this->datePublication = new \Datetime('now');
        $this->dateCreated = new \Datetime('now');
        $this->dateUpdated = new \Datetime('now');
        $this->isVisible = true;
        $this->nature = 3;

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
     *     message = "Le titre ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "1000",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="title", type="string", length=200, nullable=true)
     */
    private $title;


    /**
     * @Assert\Choice(choices = {"1","2", "3"}, message = "Choisissez un genre valide.")
     * @ORM\Column(name="nature", type="integer", length=200, nullable=true)
     */
    private $nature;

    /**
     * @Assert\NotBlank(
     *     message = "Le résumé ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "3",
     *      max = "7000",
     *      minMessage = "Votre résumé doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre résumé ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="cover", type="text", nullable=true)
     */
    private $cover;


    /**
     * @ORM\OneToMany(targetEntity="CommentaireArticle",mappedBy="article", cascade={"all"},orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @Assert\NotBlank(
     *     message = "La description ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "70000",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(name="datePublication", type="datetime", nullable=true)
     */
    private $datePublication;

    /**
     * @var string
     * @ORM\Column(name="isVisible", type="boolean", nullable=true)
     */
    private $isVisible;

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
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="articles", cascade={"all"},orphanRemoval=true)
     * @ORM\JoinTable(name="article_categories")
     */
    private $categories;


    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
     * @ORM\JoinTable(name="article_tags")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="articles")
     */
    private $produits;

    /**
     * @ORM\ManyToMany(targetEntity="Page", mappedBy="articles")
     */
    private $pages;

    /**
     * @var integer
     * @ORM\Column(name="point", type="integer", nullable=true)
     */
    private $point;


    /**
     * @ORM\OneToMany(targetEntity="Commercial", mappedBy="produit", cascade={"all"},orphanRemoval=true)
     * @ORM\OrderBy({"dateCreated" = "DESC"})
     */
    protected $commercials;


    /**
     * @var integer
     *
     * @ORM\Column(name="home", type="boolean", nullable=false)
     */
    private $home;

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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function __toString()
    {
        return Box::limit_words($this->title);
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->dateCreated = new \DateTime();
    }
    /**
     */
    public function getCreatedAtValue()
    {
        return $this->dateCreated;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Article
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Article
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }


    /**
     * Add tags
     *
     * @param \Horus\SiteBundle\Entity\Tag $tags
     * @return Article
     */
    public function addTag(\Horus\SiteBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Horus\SiteBundle\Entity\Tag $tags
     */
    public function removeTag(\Horus\SiteBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     * @return Article
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
    
        return $this;
    }

    /**
     * Get isVisible
     *
     * @return boolean 
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }


    /**
     * Set point
     *
     * @param integer $point
     * @return Article
     */
    public function setPoint($point)
    {
        $this->point = $point;
    
        return $this;
    }

    /**
     * Get point
     *
     * @return integer 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set nature
     *
     * @param integer $nature
     * @return Article
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
    
        return $this;
    }

    /**
     * Get nature
     *
     * @return integer 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set cover
     *
     * @param text $cover
     * @return Article
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Get cover
     *
     * @return text 
     */
    public function getCover()
    {
        if(!empty($this->cover))
            return $this->cover;
        else
            return Box::limit_words($this->content);
    }

    /**
     * Add produits
     *
     * @param Horus\SiteBundle\Entity\Produit $produits
     * @return Article
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
     * Set dateUpdated
     *
     * @param datetime $dateUpdated
     * @return Article
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
     * Add pages
     *
     * @param Horus\SiteBundle\Entity\Page $pages
     * @return Article
     */
    public function addPage(\Horus\SiteBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;
        return $this;
    }

    /**
     * Remove pages
     *
     * @param Horus\SiteBundle\Entity\Page $pages
     */
    public function removePage(\Horus\SiteBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add commercials
     *
     * @param Horus\SiteBundle\Entity\Commercial $commercials
     * @return Article
     */
    public function addCommercial(\Horus\SiteBundle\Entity\Commercial $commercials)
    {
        $this->commercials[] = $commercials;
        return $this;
    }

    /**
     * Remove commercials
     *
     * @param Horus\SiteBundle\Entity\Commercial $commercials
     */
    public function removeCommercial(\Horus\SiteBundle\Entity\Commercial $commercials)
    {
        $this->commercials->removeElement($commercials);
    }

    /**
     * Get commercials
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCommercials()
    {
        return $this->commercials;
    }

    /**
     * Add categories
     *
     * @param Horus\SiteBundle\Entity\Category $categories
     * @return Article
     */
    public function addCategorie(\Horus\SiteBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
        return $this;
    }

    /**
     * Remove categories
     *
     * @param Horus\SiteBundle\Entity\Category $categories
     */
    public function removeCategorie(\Horus\SiteBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add commentaires
     *
     * @param Horus\SiteBundle\Entity\CommentaireArticle $commentaires
     * @return Article
     */
    public function addCommentaire(\Horus\SiteBundle\Entity\CommentaireArticle $commentaires)
    {
        $this->commentaires[] = $commentaires;
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param Horus\SiteBundle\Entity\CommentaireArticle $commentaires
     */
    public function removeCommentaire(\Horus\SiteBundle\Entity\CommentaireArticle $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set home
     *
     * @param boolean $home
     * @return Article
     */
    public function setHome($home)
    {
        $this->home = $home;
        return $this;
    }

    /**
     * Get home
     *
     * @return boolean 
     */
    public function getHome()
    {
        return $this->home;
    }
}