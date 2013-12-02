<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Horus\SiteBundle\Util\Box;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Produit
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\ProduitRepository")
 * @ORM\Table(name="produit")
 * @ORM\HasLifecycleCallbacks()
 */
class Produit
{


    /**
     * Constructor
     */
    public function __construct(){
        $this->datePublication = new \Datetime('now');
        $this->dateCreated = new \Datetime('now');
        $this->dateUpdated = new \Datetime('now');
        $this->isShop = true;
        $this->isVisible = true;
        $this->etat = 1;
        $this->status = 1;
        $this->quantity = 1;
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
     * @Assert\NotBlank(
     *     message = "La référence ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "4",
     *      max = "1000",
     *      minMessage = "Votre référence doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre référence ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="reference", type="string", length=200, nullable=false)
     */
    private $reference;

    /**
     * @var integer
     * @Assert\Url(message="Votre URL de Vidéo n'est pas valide")
     * @Assert\Length(
     *      min = "8",
     *      max = "1000",
     *      minMessage = "Votre video doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre video ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="video", type="string", length=200, nullable=false)
     */
    private $video;

    /**
     * @Assert\Length(
     *      min = "8",
     *      max = "1000",
     *      minMessage = "Votre service doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre service ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="service", type="text", nullable=false)
     */
    private $service;

    /**
     * @var integer
     * @Assert\Regex(pattern="/^([0-9]){13}$/", message="EAN 13 est invalide")
     * @ORM\Column(name="ean", type="string", length=200, nullable=false)
     */
    private $ean;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;
    

    /**
     * @var integer
     *
     * @ORM\Column(name="isShop", type="boolean", nullable=false)
     */
    private $isShop;


    /**
     * @Assert\NotBlank(
     *     message = "Le prix TTC ne doit pas etre vide"
     * )
     * @Assert\Regex(pattern="/[0-9]{1,}[.,]{0,1}[0-9]{0,2}/", message="Le prix TTC n'est pas valide")
     * @ORM\Column(name="prixTTC", type="float", nullable=false)
     */
    private $prixTTC;

    /**
     * @Assert\NotBlank(
     *     message = "Le prix HT ne doit pas etre vide"
     * )
     * @Assert\Regex(pattern="/[0-9]{1,}[.,]{0,1}[0-9]{0,2}/", message="Le prix HT n'est pas valide")
     * @ORM\Column(name="prixHT", type="float", nullable=false)
     */
    private $prixHT;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


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
     * @Assert\NotBlank(
     *     message = "L'accroche ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "1000",
     *      minMessage = "Votre accroche doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre accroche ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="accroche", type="string", length=200, nullable=true)
     */
    private $accroche;


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
     *      max = "3000",
     *      minMessage = "Votre résumé doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre résumé ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="cover", type="text", nullable=true)
     */
    private $cover;

    /**
     * @Assert\NotBlank(
     *     message = "La description ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "3000",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @Assert\Length(
     *      min = "8",
     *      max = "1000",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="extras", type="text", nullable=true)
     */
    private $extras;

    /**
     * @var string
     * @Assert\DateTime(message = "Votre date de publication est invalide")
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
     * @ORM\Column(name="livraison", type="integer", nullable=true)
     */
    private $livraison;

    /**
     * @var string
     * @Assert\Type(type="integer", message="La valeur {{ value }} n'est pas un type {{ type }} valide.")
     * @ORM\Column(name="quantity", type="string", nullable=true)
     */
    private $quantity;

    /**
     * @var string
     * @ORM\Column(name="tva", type="float", nullable=true)
     */
    private $tva;

    /**
     * @var string
     * @Assert\Regex(pattern="/[0-9]{1,}[.,]{0,1}[0-9]{0,2}/", message="Le prix TTC n'est pas valide")
     * @ORM\Column(name="poid", type="float", nullable=true)
     */
    private $poid;

    /**
     * @var string
     * @ORM\Column(name="longueur", type="float", nullable=true)
     */
    private $longueur;

    /**
     * @var string
     * @ORM\Column(name="largeur", type="float", nullable=true)
     */
    private $largeur;

    /**
     * @var string
     * @ORM\Column(name="hauteur", type="float", nullable=true)
     */
    private $hauteur;

    /**
     * @var string
     * @ORM\Column(name="profondeur", type="float", nullable=true)
     */
    private $profondeur;


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
     * @ORM\ManyToOne(targetEntity="Marques", inversedBy="produits")
     * @ORM\JoinColumn(name="marque_id", referencedColumnName="id")
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity="Fournisseurs", inversedBy="produits")
     * @ORM\JoinColumn(name="fournisseur_id", referencedColumnName="id")
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="produits")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Transports", inversedBy="produits")
     * @ORM\JoinColumn(name="transport_id", referencedColumnName="id")
     */
    private $transport;


    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articless")
     * @ORM\JoinTable(name="produit_category")
     */
    private $cates;


    /**
     * @ORM\ManyToMany(targetEntity="Famille", inversedBy="produits")
     * @ORM\JoinTable(name="produit_famille")
     */
    private $familles;


    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="tags", cascade={"all"},orphanRemoval=true)
     * @ORM\JoinTable(name="produit_tags")
     */
    private $tags;


    /**
     * @var integer
     * @ORM\Column(name="point", type="integer", nullable=true)
     */
    private $point;


    /**
     * @ORM\OneToMany(targetEntity="CommandesProduit",mappedBy="produit", cascade={"all"},orphanRemoval=true)
     * @Assert\Valid
     */
    protected $commandes;

    /**
     * @ORM\OneToMany(targetEntity="Seo",mappedBy="produit", cascade={"all"},orphanRemoval=true)
     * @Assert\Valid
     */
    protected $seo;

    /**
     * @ORM\OneToMany(targetEntity="Commentaire",mappedBy="produit", cascade={"all"},orphanRemoval=true)
     */
    protected $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="Pj",mappedBy="produit", cascade={"all"},orphanRemoval=true)
     * @Assert\Valid
     */
    protected $pjs;

    /**
     * @ORM\OneToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $prodparent;


    /**
     * @ORM\OneToMany(targetEntity="Meta",mappedBy="produit", cascade={"all"},orphanRemoval=true)
     * @Assert\Valid
     */
    protected $metas;

    /**
     * @ORM\OneToMany(targetEntity="Image",mappedBy="produit", cascade={"all"},orphanRemoval=true)
     * @Assert\Valid
     * @ORM\OrderBy({"dateCreated" = "DESC"})
     */
    protected $images;


    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="produits", cascade={"all"},orphanRemoval=true)
     * @ORM\JoinTable(name="article_produit")
     */
    protected $articles;

    /**
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="articlesaccesories")
     * @ORM\OrderBy({"dateCreated" = "DESC"})
     */
    protected $accesories;

    /**
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="accesories",cascade={"all"},orphanRemoval=true)
     * @ORM\JoinTable(name="produit_accessories")
     */
    protected $articlesaccesories;


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
     * @param text $title
     * @return Image
     */
    public function getStarPicture()
    {
        $images = $this->getImages();
        if(!empty($images))
            foreach($images as $image){
               if($image->getCover() == true){
                   return $image;
                   break;
               }
            }

        return null;
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
     * Set category
     *
     * @param \Horus\SiteBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory(\Horus\SiteBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Horus\SiteBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
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
     * Set reference
     *
     * @param string $reference
     * @return Produit
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
     * Set ean
     *
     * @param string $ean
     * @return Produit
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * Get ean
     *
     * @return string 
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Produit
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set isShop
     *
     * @param boolean $isShop
     * @return Produit
     */
    public function setIsShop($isShop)
    {
        $this->isShop = $isShop;
        return $this;
    }

    /**
     * Get isShop
     *
     * @return boolean 
     */
    public function getIsShop()
    {
        return $this->isShop;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Produit
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
     * Set livraison
     *
     * @param integer $livraison
     * @return Produit
     */
    public function setLivraison($livraison)
    {
        $this->livraison = $livraison;
        return $this;
    }

    /**
     * Get livraison
     *
     * @return integer 
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * Set extras
     *
     * @param text $extras
     * @return Produit
     */
    public function setExtras($extras)
    {
        $this->extras = $extras;
        return $this;
    }

    /**
     * Get extras
     *
     * @return text 
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Set prixTTC
     *
     * @param float $prixTTC
     * @return Produit
     */
    public function setPrixTTC($prixTTC)
    {
        $this->prixTTC = $prixTTC;
        return $this;
    }

    /**
     * Get prixTTC
     *
     * @return float 
     */
    public function getPrixTTC()
    {
        return $this->prixTTC;
    }

    /**
     * Set prixHT
     *
     * @param float $prixHT
     * @return Produit
     */
    public function setPrixHT($prixHT)
    {
        $this->prixHT = $prixHT;
        return $this;
    }

    /**
     * Get prixHT
     *
     * @return float 
     */
    public function getPrixHT()
    {
        return $this->prixHT;
    }


    /**
     * Set tva
     *
     * @param integer $tva
     * @return Produit
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
        return $this;
    }

    /**
     * Get tva
     *
     * @return integer 
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Produit
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
     * Add seo
     *
     * @param Horus\SiteBundle\Entity\Seo $seo
     * @return Produit
     */
    public function addSeo(\Horus\SiteBundle\Entity\Seo $seo)
    {
        $this->seo[] = $seo;
        return $this;
    }

    /**
     * Remove seo
     *
     * @param Horus\SiteBundle\Entity\Seo $seo
     */
    public function removeSeo(\Horus\SiteBundle\Entity\Seo $seo)
    {
        $this->seo->removeElement($seo);
    }

    /**
     * Get seo
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * Add metas
     *
     * @param Horus\SiteBundle\Entity\Meta $metas
     * @return Produit
     */
    public function addMeta(\Horus\SiteBundle\Entity\Meta $metas)
    {
        $metas->setProduit($this);
        $this->metas[] = $metas;
        return $this;
    }

    /**
     * Remove metas
     *
     * @param Horus\SiteBundle\Entity\Meta $metas
     */
    public function removeMeta(\Horus\SiteBundle\Entity\Meta $metas)
    {
        $this->metas->removeElement($metas);
    }

    /**
     * Get metas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMetas()
    {
        return $this->metas;
    }

    /**
     * Add cates
     *
     * @param Horus\SiteBundle\Entity\Category $cates
     * @return Produit
     */
    public function addCate(\Horus\SiteBundle\Entity\Category $cates)
    {
        $this->cates[] = $cates;
        return $this;
    }

    /**
     * Remove cates
     *
     * @param Horus\SiteBundle\Entity\Category $cates
     */
    public function removeCate(\Horus\SiteBundle\Entity\Category $cates)
    {
        $this->cates->removeElement($cates);
    }

    /**
     * Get cates
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCates()
    {
        return $this->cates;
    }

    /**
     * Set accroche
     *
     * @param string $accroche
     * @return Produit
     */
    public function setAccroche($accroche)
    {
        $this->accroche = $accroche;
        return $this;
    }

    /**
     * Get accroche
     *
     * @return string 
     */
    public function getAccroche()
    {
        return $this->accroche;
    }



    /**
     * Set prodparent
     *
     * @param Horus\SiteBundle\Entity\Produit $prodparent
     * @return Produit
     */
    public function setProdparent(\Horus\SiteBundle\Entity\Produit $prodparent = null)
    {
        $this->prodparent = $prodparent;
        return $this;
    }

    /**
     * Get prodparent
     *
     * @return Horus\SiteBundle\Entity\Produit
     */
    public function getProdparent()
    {
        return $this->prodparent;
    }

    /**
     * Add articles
     *
     * @param Horus\SiteBundle\Entity\Article $articles
     * @return Produit
     */
    public function addArticle(\Horus\SiteBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
        return $this;
    }

    /**
     * Remove articles
     *
     * @param Horus\SiteBundle\Entity\Article $articles
     */
    public function removeArticle(\Horus\SiteBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return Produit
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set service
     *
     * @param text $service
     * @return Produit
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @param ArrayCollection $metas
     */
    public function setMetas(ArrayCollection $metas)
    {
        foreach ($metas as $meta) {
            $meta->addMeta($this);
        }

        $this->metas = $metas;
    }

    /**
     * Get service
     *
     * @return text 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add accesories
     *
     * @param Horus\SiteBundle\Entity\Produit $accesories
     * @return Produit
     */
    public function addAccesory(\Horus\SiteBundle\Entity\Produit $accesories)
    {
        $this->accesories[] = $accesories;
        return $this;
    }

    /**
     * Remove accesories
     *
     * @param Horus\SiteBundle\Entity\Produit $accesories
     */
    public function removeAccesory(\Horus\SiteBundle\Entity\Produit $accesories)
    {
        $this->accesories->removeElement($accesories);
    }

    /**
     * Get accesories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAccesories()
    {
        return $this->accesories;
    }

    /**
     * Add articlesaccesories
     *
     * @param Horus\SiteBundle\Entity\Produit $articlesaccesories
     * @return Produit
     */
    public function addArticlesaccesorie(\Horus\SiteBundle\Entity\Produit $articlesaccesories)
    {
        $this->articlesaccesories[] = $articlesaccesories;
        return $this;
    }

    /**
     * Remove articlesaccesories
     *
     * @param Horus\SiteBundle\Entity\Produit $articlesaccesories
     */
    public function removeArticlesaccesorie(\Horus\SiteBundle\Entity\Produit $articlesaccesories)
    {
        $this->articlesaccesories->removeElement($articlesaccesories);
    }

    /**
     * Get articlesaccesories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArticlesaccesories()
    {
        return $this->articlesaccesories;
    }

    /**
     * Set dateUpdated
     *
     * @param datetime $dateUpdated
     * @return Produit
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
     * Add accesories
     *
     * @param Horus\SiteBundle\Entity\Produit $accesories
     * @return Produit
     */
    public function addAccesorie(\Horus\SiteBundle\Entity\Produit $accesories)
    {
        $this->accesories[] = $accesories;
        return $this;
    }

    /**
     * Remove accesories
     *
     * @param Horus\SiteBundle\Entity\Produit $accesories
     */
    public function removeAccesorie(\Horus\SiteBundle\Entity\Produit $accesories)
    {
        $this->accesories->removeElement($accesories);
    }

    /**
     * Add images
     *
     * @param Horus\SiteBundle\Entity\Image $images
     * @return Produit
     */
    public function addImage(\Horus\SiteBundle\Entity\Image $images)
    {
        $this->images[] = $images;
        return $this;
    }

    /**
     * Remove images
     *
     * @param Horus\SiteBundle\Entity\Image $images
     */
    public function removeImage(\Horus\SiteBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add familles
     *
     * @param Horus\SiteBundle\Entity\Famille $familles
     * @return Produit
     */
    public function addFamille(\Horus\SiteBundle\Entity\Famille $familles)
    {
        $this->familles[] = $familles;
        return $this;
    }

    /**
     * Remove familles
     *
     * @param Horus\SiteBundle\Entity\Famille $familles
     */
    public function removeFamille(\Horus\SiteBundle\Entity\Famille $familles)
    {
        $this->familles->removeElement($familles);
    }

    /**
     * Get familles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFamilles()
    {
        return $this->familles;
    }

    /**
     * Set poid
     *
     * @param float $poid
     * @return Produit
     */
    public function setPoid($poid)
    {
        $this->poid = $poid;
        return $this;
    }

    /**
     * Get poid
     *
     * @return float 
     */
    public function getPoid()
    {
        return $this->poid;
    }

    /**
     * Set longueur
     *
     * @param float $longueur
     * @return Produit
     */
    public function setLongueur($longueur)
    {
        $this->longueur = $longueur;
        return $this;
    }

    /**
     * Get longueur
     *
     * @return float 
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * Set largeur
     *
     * @param float $largeur
     * @return Produit
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;
        return $this;
    }

    /**
     * Get largeur
     *
     * @return float 
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set hauteur
     *
     * @param float $hauteur
     * @return Produit
     */
    public function setHauteur($hauteur)
    {
        $this->hauteur = $hauteur;
        return $this;
    }

    /**
     * Get hauteur
     *
     * @return float 
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }

    /**
     * Set profondeur
     *
     * @param float $profondeur
     * @return Produit
     */
    public function setProfondeur($profondeur)
    {
        $this->profondeur = $profondeur;
        return $this;
    }

    /**
     * Get profondeur
     *
     * @return float 
     */
    public function getProfondeur()
    {
        return $this->profondeur;
    }

    /**
     * Add pjs
     *
     * @param Horus\SiteBundle\Entity\Pj $pjs
     * @return Produit
     */
    public function addPj(\Horus\SiteBundle\Entity\Pj $pjs)
    {
        $this->pjs[] = $pjs;
        $pjs->setProduit($this);
        return $this;
    }

    /**
     * Remove pjs
     *
     * @param Horus\SiteBundle\Entity\Pj $pjs
     */
    public function removePj(\Horus\SiteBundle\Entity\Pj $pjs)
    {
        $this->pjs->removeElement($pjs);
    }

    /**
     * Get pjs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPjs()
    {
        return $this->pjs;
    }

    /**
     * Set transport
     *
     * @param Horus\SiteBundle\Entity\Transports $transport
     * @return Produit
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
     * Add commandes
     *
     * @param Horus\SiteBundle\Entity\CommandesProduit $commandes
     * @return Produit
     */
    public function addCommande(\Horus\SiteBundle\Entity\CommandesProduit $commandes)
    {
        $this->commandes[] = $commandes;
        return $this;
    }

    /**
     * Remove commandes
     *
     * @param Horus\SiteBundle\Entity\CommandesProduit $commandes
     */
    public function removeCommande(\Horus\SiteBundle\Entity\CommandesProduit $commandes)
    {
        $this->commandes->removeElement($commandes);
    }

    /**
     * Get commandes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Add commentaires
     *
     * @param Horus\SiteBundle\Entity\Commentaire $commentaires
     * @return Produit
     */
    public function addCommentaire(\Horus\SiteBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param Horus\SiteBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Horus\SiteBundle\Entity\Commentaire $commentaires)
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
     * Set marque
     *
     * @param Horus\SiteBundle\Entity\Marque $marque
     * @return Produit
     */
    public function setMarque(\Horus\SiteBundle\Entity\Marques $marque = null)
    {
        $this->marque = $marque;
        return $this;
    }

    /**
     * Get marque
     *
     * @return Horus\SiteBundle\Entity\Marque 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set fournisseur
     *
     * @param Horus\SiteBundle\Entity\Fournisseurs $fournisseur
     * @return Produit
     */
    public function setFournisseur(\Horus\SiteBundle\Entity\Fournisseurs $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;
        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return Horus\SiteBundle\Entity\Fournisseurs 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Produit
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}