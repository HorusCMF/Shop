<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Seo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Horus\SiteBundle\Entity\Produit;


/**
 * Class LoadProductsDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadProductsDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $produit = new Produit();
        $produit->setTitle("Samsung UE46F6400 TV LCD 46 (116 cm) LED HD TV 1080p 3D Smart TV avec Wi-Fi intégré 2 paires de lunettes 3D 200 Hz 4 HDMI 3 USB Classe: A");
        $accroche = "Profitez d’une expérience de visionnage unique et captivante grâce au design de pointe du téléviseur F6400 de Samsung. Son cadre mince et léger est associé à un élégant pied à quatre branches, soulignant toute l’innovation et toute la qualité de ce téléviseur. Conçu avec des matériaux nobles et robustes, il combine élégamment la stabilité avec la finesse des ses lignes. Allumé comme éteint, le téléviseur F6400 s’intégrera parfaitement dans votre intérieur et ajoutera une touche élégante à votre pièce.";
        $content = "<div class='three-fourth-col'> <div class='leftImage' style='width: 420px;'><img src='http://g-ecx.images-amazon.com/images/G/08/product/electronic/Aplus/img_F6400_m06.jpg' alt='Clear motion' width='400' height='230'> <div class='imageCaption'> <p>Clear Motion Rate de Samsung, des images toujours plus fluides.</p>    </div></div><div class='leftImage' style='width: 420px;'><img src='http://g-ecx.images-amazon.com/images/G/08/product/electronic/Aplus/mf05_body_apps1.jpg' alt='Mes Programmes' width='400' height='230'> <div class='imageCaption'> <p>Mes programmes</p> </div></div><div class='leftImage' style='width: 420px;'><img src='http://g-ecx.images-amazon.com/images/G/08/product/electronic/Aplus/img_F6400_m05.jpg' alt='AllShare' width='400' height='190'> <div class='imageCaption'> <p>AllShare cast</p> </div></div><h4>S recommandation</h4><p>S Recommandation avec Interaction Vocale vous recommande les contenus que vous avez envie de regarder. Vous n'avez plus à zapper sur toutes les chaînes, il vous suffit de demander à votre téléviseur. S Recommandation se base sur vos habitudes de visionnage pour vous conseiller de nouveaux contenus que vous allez adorer. Plus vous utilisez S Recommandation, plus il devient intelligent pour vous proposer des contenus toujours plus en affinité avec vos goûts personnels.</p><h4>Voice Interaction</h4><p>Le contrôle devient interaction. Vous pouvez désormais commander votre Smart TV Samsung avec un phrasé naturel. Utilisez le bouton Voice de votre télécommande Smart Touch pour interroger votre téléviseur. Parlez naturellement et il répondra à votre voix en vous proposant une sélection de contenus personnalisés : programmes en cours, programmes à venir, vidéos à la demande ou applications. Vous pouvez demander ce que vous voulez.</p><h4>Smart Hub</h4> <p>Découvrez une manière instinctive et intuitive de naviguer sur votre   Smart TV. La nouvelle interface Smart TV 2013 vous plonge au cœur du   divertissement grâce à ses 5 volets dynamiques. Découvrir, explorer et   partager vos contenus n'a jamais été aussi simple et plaisant.</p> <h4>Mes programmes: page d’accueil</h4><p>La page 'Mes Programmes' vous affiche simultanément votre programme en cours ainsi que des recommandations d’émissions personnalisés, selon vos goûts et vos préférences. Ne ratez plus vos émissions préférées. Votre Smart TV vous proposera toujours quelque chose de bien à regarder ! </p><h4>AllShare Cast</h4><p>Dupliquez l'écran de votre smartphone ou de votre tablette sur votre téléviseur ! La fonction Allshare Cast vous permet de refléter l'écran de vos appareils connectés directement sur votre Smart TV. Partagez et profitez ainsi en toute simplicité de vos contenus, photos et vidéos, sur l'écran de votre TV. </p><h4>Smart View</h4> <p>Grâce à la fonction Smart View, partagez les flux de votre Smart TV sur vos différents appareils connectés. Utilisez votre smartphone ou votre tablette comme un deuxième téléviseur en y affichant directement l'écran de votre TV. Diffusez ainsi vos contenus multimédia, en temps réel, et sans fil.</p><h4>SoundShare</h4><p>La technologie SoundShare vous propose de diffuser sans fil, le son de votre téléviseur via un dispositif audio externe Samsung compatible. Connectez votre système audio à votre TV en activant la fonction SoundShare et profitez pleinement du son de vos programmes préférés et de vos contenus multimédia sans vous encombrer de câbles inutiles.</p></div>";
        $cover = "Doté du puissant processeur d'image 3D HyperReal Engine, le téléviseur LED UE40F6400 de Samsung promet une immersion inédite dans l'expérience 3D. L'homogénéité de la dalle est parfaite pour profiter de vos chaînes TV préférées. Grâce à une résolution Full HD 1080p, cette télévision UE40F6400 affiche un rendu riche et naturel pour une expérience visuelle inoubliable. La dalle réactive offre un excellent angle de vision. Le son n'est pas en reste via la technologie sonore 3D et des haut-parleurs de bonne facture. Offrant une connectique complète, ce téléviseur UE 40F6400 accueille tous vos appareils numériques. La fonction AllShare se connecte à votre équipement compatible afin de diffuser de la musique, des films et des photos. Par ailleurs, les ports HDMI permettent une connexion directe avec 4 appareils. Connecté par Ethernet ou via le WiFi intégré, ce téléviseur offre un accès à l'ensemble des services Samsung Smart TV, A partir du Smart Hub 2013. Vous pouvez ainsi naviguer à loisir parmi les univers utilisateur grâce à des pages dédiées à chaque type de contenus . Le téléviseur LED Samsung UE40F6400 est l'appareil optimal pour un divertissement HD complet. Ce téléviseur est livré avec 2 paires de lunettes 3D Active (modèle SSG-5100GB).";

        $produit->setReference('AX087-B');
        $produit->setPrixTTC(26.2);
        $produit->setPrixHT(22.2);
        $produit->setContent($content);
        $produit->setAccroche($accroche);
        $produit->setCover($cover);
        $produit->setEan('1234567891234');
        $produit->setEtat(1);
        $produit->setIsShop(1);
        $produit->setTva(19.6);
        $produit->setQuantity(25);
        $produit->setPoint(5);
        $produit->setPoid(15);
        $produit->setLongueur(107);
        $produit->setLargeur(40);
        $produit->setVideo("http://www.youtube.com/watch?v=Hw7xsA1zCiY");
        $produit->setService("Garantie 2 ans");
        $produit->setExtras("Produit de Test");



        /**
         * Add SEO
         */
        $seo = new Seo();
        $seo->setTitle('Samsung Ecran LCD');
        $seo->setKeywords('LCD,Ecran,Samsung');
        $seo->setDescription("L'écran à cristaux liquides, (ACL pour affichage à cristaux liquides, ou en anglais : LCD pour liquid crystal display), permet la création d’écran plat à faible consommation d'électricité. Aujourd'hui ces écrans sont utilisés dans presque tous les affichages électroniques.");
        $seo->setProduit($produit);


        /**
         * Add Group
         */
        $em = $this->container->get('doctrine.orm.entity_manager');
        $category = $em->getRepository('HorusSiteBundle:Category')->find(10);
        $transport = $em->getRepository('HorusSiteBundle:Transports')->find(80);
        $fournisseur = $em->getRepository('HorusSiteBundle:Fournisseurs')->find(5);
        $marque = $em->getRepository('HorusSiteBundle:Marques')->find(5);

        $produit->setCategory($category);
        $produit->setTransport($transport);
        $produit->setFournisseur($fournisseur);
        $produit->setMarque($marque);

        $manager->persist($produit);
        $manager->persist($seo);
//        $manager->flush();
    }


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}
