<?php

namespace Horus\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations


/**
 * Commercial
 * @ORM\Entity(repositoryClass="Horus\SiteBundle\Repository\CommercialRepository")
 * @ORM\Table(name="commercial")
 * @ORM\HasLifecycleCallbacks()
 */
class Commercial
{

    public function __construct(){
        $this->datePublication = new \Datetime('now');
        $this->dateCreated = new \Datetime('now');
        $this->dateUpdated = new \Datetime('now');
        $this->isVisible = true;
        $this->offert = false;
        $this->remiseNet = 0;
        $this->remiseVar = 0;
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
     * @ORM\Column(name="nature", type="integer", nullable=true)
     */
    private $nature;

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
     *     message = "La description ne doit pas etre vide"
     * )
     * @Assert\Length(
     *      min = "5",
     *      max = "1000",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(name="remise_net", type="float", nullable=true)
     */
    private $remiseNet;

    /**
     * @ORM\Column(name="remise_var", type="float", nullable=true)
     */
    private $remiseVar;

    /**
     * @ORM\Column(name="offert", type="boolean", nullable=true)
     */
    private $offert;

    /**
     * @var string
     * @ORM\Column(name="datePublication", type="datetime", nullable=true)
     */
    private $datePublication;

    /**
     * @var string
     * @ORM\Column(name="dateFinPublication", type="datetime", nullable=true)
     */
    private $dateFinPublication;

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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="commercials")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


    /**
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="commercials")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;



    /**
     * @Assert\Image(
     *     minWidth = 200,
     *     minHeight  = 100,
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
     * @ORM\Column(name="path", type="string", length=3000, nullable=true)
     */
    private $path;


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
     * @return Commercial
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
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
     * @param text $content
     * @return Commercial
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
     * Set datePublication
     *
     * @param datetime $datePublication
     * @return Commercial
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return datetime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     * @return Commercial
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
     * Set dateCreated
     *
     * @param datetime $dateCreated
     * @return Commercial
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
     * @return Commercial
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
     * Set category
     *
     * @param Horus\SiteBundle\Entity\Category $category
     * @return Commercial
     */
    public function setCategory(\Horus\SiteBundle\Entity\Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Horus\SiteBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set produit
     *
     * @param Horus\SiteBundle\Entity\Produit $produit
     * @return Commercial
     */
    public function setProduit(\Horus\SiteBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;
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

    /**
     * Set remiseNet
     *
     * @param float $remiseNet
     * @return Commercial
     */
    public function setRemiseNet($remiseNet)
    {
        $this->remiseNet = $remiseNet;
        return $this;
    }

    /**
     * Get remiseNet
     *
     * @return float 
     */
    public function getRemiseNet()
    {
        return $this->remiseNet;
    }

    /**
     * Set remiseVar
     *
     * @param float $remiseVar
     * @return Commercial
     */
    public function setRemiseVar($remiseVar)
    {
        $this->remiseVar = $remiseVar;
        return $this;
    }

    /**
     * Get remiseVar
     *
     * @return float 
     */
    public function getRemiseVar()
    {
        return $this->remiseVar;
    }

    /**
     * Set offert
     *
     * @param boolean $offert
     * @return Commercial
     */
    public function setOffert($offert)
    {
        $this->offert = $offert;
        return $this;
    }

    /**
     * Get offert
     *
     * @return boolean 
     */
    public function getOffert()
    {
        return $this->offert;
    }

    /**
     * Set nature
     *
     * @param integer $nature
     * @return Commercial
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
     * Set dateFinPublication
     *
     * @param datetime $dateFinPublication
     * @return Commercial
     */
    public function setDateFinPublication($dateFinPublication)
    {
        $this->dateFinPublication = $dateFinPublication;
        return $this;
    }

    /**
     * Get dateFinPublication
     *
     * @return datetime 
     */
    public function getDateFinPublication()
    {
        return $this->dateFinPublication;
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
        return 'uploads/commercials/';
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



    /**
     * Set path
     *
     * @param string $path
     * @return Commercial
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
}