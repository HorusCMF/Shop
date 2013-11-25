<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Famille
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\FamilleRepository")
 * @ORM\Table(name="famille")
 * @ORM\HasLifecycleCallbacks()
 */
class Famille
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
     * @Assert\NotBlank(
     *     message = "Le titre ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "3",
     *      max = "1000",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=200, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     */
    private $path;
    
    /**
     * @Assert\NotBlank(
     *     message = "La description ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "1000",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @Assert\NotBlank(
     *     message = "Le résumé ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "3",
     *      max = "1000",
     *      minMessage = "Votre résumé doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre résumé ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="cover", type="text", nullable=true)
     */
    private $cover;


    /**
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="familles", cascade={"all"},orphanRemoval=true)
     */
    protected $produits;


    /**
     * @var string
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;


    /**
     * @var string
     *
     * @ORM\Column(name="visible", type="boolean", nullable=true)
     */
    private $visible;


    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;


    /**
     * @ORM\OneToMany(targetEntity="ImageCategory",mappedBy="category", cascade={"all"},orphanRemoval=true)
     * @ORM\OrderBy({"dateCreated" = "DESC"})
     */
    protected $images;


    /**
     * @Assert\Image(
     *     minWidth = 200,
     *     minHeight  = 200,
     *     maxWidth = 3000,
     *     maxHeight = 3000,
     *     maxSize = "6000k",
     *     mimeTypes = {"image/jpg","image/jpeg", "image/png", "image/gif", "image/bmp"},
     *     mimeTypesMessage = "Image au format non supporté",
     *    maxWidthMessage = "Image trop grande en largeur {{ width }}px. Le maximum en largeur est de {{ max_width }}px" ,
     *    minWidthMessage = "Image trop petite en largeur {{ width }}px. Le minimum en largeur est de {{ min_width }}px" ,
     *    minHeightMessage = "Image trop petite en hauteur {{ height }}px. Le mimum en hauteur est de {{ min_height }}px" ,
     *    maxHeightMessage = "Image trop grande en hauteur  {{ height }}px. Le maximum en hauteur est de {{ max_height }}px"
     * )
     */
    public $file;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visible = true;
        $this->dateCreated = new \DateTime('now');
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
     * Set name
     *
     * @param string $name
     * @return Famille
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Famille
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Famille
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set cover
     *
     * @param text $cover
     * @return Famille
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
        return $this->cover;
    }

    /**
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Famille
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
     * Set visible
     *
     * @param boolean $visible
     * @return Famille
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Famille
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Famille
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Famille
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Famille
     */
    public function setRoot($root)
    {
        $this->root = $root;
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Add produits
     *
     * @param Horus\SiteBundle\Entity\Produit $produits
     * @return Famille
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
     * Set parent
     *
     * @param Horus\SiteBundle\Entity\Category $parent
     * @return Famille
     */
    public function setParent(\Horus\SiteBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Horus\SiteBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Horus\SiteBundle\Entity\Category $children
     * @return Famille
     */
    public function addChildren(\Horus\SiteBundle\Entity\Category $children)
    {
        $this->children[] = $children;
        return $this;
    }

    /**
     * Remove children
     *
     * @param Horus\SiteBundle\Entity\Category $children
     */
    public function removeChildren(\Horus\SiteBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add images
     *
     * @param Horus\SiteBundle\Entity\ImageCategory $images
     * @return Famille
     */
    public function addImage(\Horus\SiteBundle\Entity\ImageCategory $images)
    {
        $this->images[] = $images;
        return $this;
    }

    /**
     * Remove images
     *
     * @param Horus\SiteBundle\Entity\ImageCategory $images
     */
    public function removeImage(\Horus\SiteBundle\Entity\ImageCategory $images)
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
     * Get images
     */
    public function __toString()
    {
        return $this->name;
    }






    /**
     *  Upload Images
     *
     * @return text
     */

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/familles/';
    }



    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload($id = null)
    {

        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }

        if(!is_dir(@mkdir($this->getUploadRootDir().'/'.$id)))
            @mkdir($this->getUploadRootDir().'/'.$id);


        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé

        $rewritename = sha1(uniqid(mt_rand(), true));
        $rewritefile = $rewritename.'.'.$this->file->guessExtension();
        $extension = $this->file->guessExtension();

        $this->file->move($this->getUploadRootDir().'/'.$id, $rewritefile);

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->path = $rewritefile;

//        $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();

        //Original photo
        $bigfile = $this->getUploadRootDir().'/'.$id.'/'.$rewritefile;

        if ($extension == "jpg" || $extension == "jpeg") {
            $src_img = imagecreatefromjpeg($bigfile);
        }
        if ($extension == "png") {
            $src_img = imagecreatefrompng($bigfile);
        }
        if ($extension == "gif") {
            $src_img = imagecreatefromgif($bigfile);
        }

        // Le ratio de l'image uploadée
        $oldWidth = imageSX($src_img);
        $oldHeight = imageSY($src_img);
        $ratio = $oldWidth / $oldHeight;

        $taille = array(
            array(
                'name' => 'big',
                'width' => 500,
                'height' => 300
            ),
            array(
                'name' => 'medium',
                'width' => 300,
                'height' => 260
            ),
            array(
                'name' => 'small',
                'width' => 250,
                'height' => 180
            ),
        );

        // C'est parti
        foreach ($taille as $value) {

            // On prépare les valeurs
            $width = $value['width'] - 1;
            $height = $value['height'] -1;
            $ratioImg = $width / $height;

            // On calcule les nouvelles
            if ($ratioImg > $ratio) {
                $newWidth = $width;
                $newHeight = $width / $ratio;
            } elseif ($ratioImg < $ratio) {
                $newHeight = $height;
                $newWidth = $height * $ratio;
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }

            // Point de départ du crop
            $x = ($newWidth - $width) / 2;
            $y = 0;

            // On bosse sur l'image
            $imagine = new \Imagine\Gd\Imagine();
            $imagine
                ->open($bigfile)
                ->thumbnail(new \Imagine\Image\Box($newWidth, $newHeight))
                ->save(
                    $this->getUploadRootDir().'/'.$id.'/' . $rewritename . '-' . $value['name'] . '.' . $extension,
                    array(
                        'quality' => 80
                    )
                );
        }

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            @unlink($file);
        }
    }


}