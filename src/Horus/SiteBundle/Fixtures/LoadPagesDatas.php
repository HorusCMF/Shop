<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Page;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadArticlesDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadPagesDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $page = new Page();
        $page->setName("A propos des Home cinema et Installations");

        $description = "<div class='SVDv3_article_element mceContentBody'><p>En matière de cinéma à domicile, le son revêt un caractère aussi important que l’image, sinon plus. Il faut savoir que l’oreille entend davantage d’informations que l’oeil n’en voit. En outre, un son de qualité souligne l’action, donne subjectivement à l’image plus de lisibilité. Ce n’est d’ailleurs pas un hasard si l’industrie du cinéma améliore sans cesse la qualité des pistes audio des films DVD et Blu-ray, et que les fabricants d’<a title='Tous les amplis home cinema' href='http://www.son-video.com/Rayons/HomeCinema/AmpliAV/CatAmpliAV.html'>amplis home cinéma</a>, de <a title='Tous les lecteurs Blu-ray pour le home cinema' href='http://www.son-video.com/Rayons/HomeCinema/DiscHD/CatLecteurHD.html'>lecteurs Blu-ray </a>ou d’<a title='Packs enceintes home cinema' href='http://www.son-video.com/Rayons/HomeCinema/EnceintesAV/CatEnceintesAVGrdS.html'>enceintes</a> font de même. Pour profiter d’un son semblable à celui des salles de cinéma avec les tout derniers films en haute définition, il vous faudra faire l’acquisition au minimum d’un <a title='Tous les amplis home cinema' href='http://www.son-video.com/Rayons/HomeCinema/AmpliAV/CatAmpliAV.html'>ampli home cinema</a>, d’un <a title='Tous les lecteur de disques Blu-ray pour le home cinema' href='http://www.son-video.com/Rayons/HomeCinema/DiscHD/CatLecteurHD.html'>lecteur de disques Blu-ray</a> et de <a title='Packs enceintes home cinema' href='http://www.son-video.com/Rayons/HomeCinema/EnceintesAV/CatEnceintesAVGrdS.html'>5 enceintes</a> qui gagneront à être épaulées par un <a title='Tous les caissons de basses pour le home cinema' href='http://www.son-video.com/Rayons/HomeCinema/Sub/CatSub.html'>caisson de basses</a>.</p>
                        <h4>L'amplificateur home cinema</h4>
                        <p><a title='Amplificateur home cinema Onkyo TX-NR3010' href='http://www.son-video.com/images/dynamic/Amplificateurs_home_cinema/articles/Onkyo/ONKTXNR3010NR/Onkyo-TX-NR3010-Noir_3QD_1200.jpg'><img class='SVDv3_image_alignDroite' title='Ampli home cinema Onkyo TX-NR3010' src='http://www.son-video.com/images/dynamic/Amplificateurs_home_cinema/articles/Onkyo/ONKTXNR3010NR/Onkyo-TX-NR3010-Noir_3QD_300.jpg' alt='Ampli home cinema Onkyo TX-NR3010' width='240' height='123'></a>Le choix d’un&nbsp;<a title='Tous les amplis home cinema' href='http://www.son-video.com/Rayons/HomeCinema/AmpliAV/CatAmpliAV.html'>amplificateur home cinéma</a> dépend de plusieurs critères. Il doit être adapté aux caractéristiques de votre pièce d’écoute, à vos enceintes, ainsi qu’à vos préférences acoustiques. Pour une écoute paisible dans une pièce de vie de moins de 20 m², un amplificateur dit 5.1, capable néanmoins de décoder les pistes audio haute définition Dolby True-HD et DTS-HD permettra de profiter d’une ambiance multicanal plaisante. Toutefois, une montée en gamme permet d’améliorer très concrètement la qualité du son restitué grâce à des composants électroniques plus puissants. L’autocalibration et l’égalisation du son restitué par les enceintes au moyen d’un microphone, ou bien la distribution d’un signal stéréo en 5.1 ou 7.1 sont des fonctions de confort très efficaces pour profiter d’un son plus réaliste. Les&nbsp;<a title='Tous les amplis home cinema' href='http://www.son-video.com/Rayons/HomeCinema/AmpliAV/CatAmpliAV.html'>amplificateurs home cinéma</a> haut de gamme, quoique destinés à alimenter de grandes enceintes et à produire un fort niveau acoustique dans une salle dédiée, peuvent parfaitement officier au salon. Qui peut le plus, peut le moins ! Enfin, une connexion au réseau domestique permet d’accéder aux contenus multimédia d’un NAS ou d’un ordinateur, ainsi qu’aux radios Internet, tout en ouvrant la possibilité d’un pilotage de l’ampli par le biais d’un smartphone ou d’une tablette.</p>
                        <h4>Le lecteur Blu-ray</h4>
                        <p>Sources d’excellence pour le home cinema, les nouveaux <a title='Lecteurs Blu-ray et DVD pour le home cinema' href='http://www.son-video.com/Rayons/HomeCinema/DiscHD/CatLecteurHD.html'>lecteurs de disques Blu-ray </a>sont compatibles avec les formats multicanal Dolby TrueHD et DTS-HD ainsi qu’avec les pistes audio des films DVD et des CD-Audio. À quelques exceptions haut de gamme et audiophiles, ces lecteurs se contentent le plus souvent de transporter le flux audio numérique à l’amplificateur home cinema qui en assure le décodage. En revanche, tous ne sont pas équipés d’une prise réseau, fort pratique pourtant pour la lecture des films stockés sur un réseau domestique. C’est un point à prendre sérieusement en compte alors que la dématérialisation des supports s’accélère !</p>
                        <h4><img class='SVDv3_image_alignGauche' title='Pack d'enceintes home cinema Tangent Evo E34 System' src='http://www.son-video.com/images/dynamic/Kits_d_enceintes/composes/TANGKITEVOE34BC/Tangent-Evo-E34-System-blanc-laque_P_180.jpg' alt='Pack d'enceintes home cinema Tangent Evo E34 System' width='121' height='180'>Les packs d'enceintes home cinema et le caisson de basses</h4>
                        <p><img class='SVDv3_image_alignDroite' title='Caisson de basses home cinema Earthquake MiniMe FF8' src='http://www.son-video.com/images/dynamic/Caissons_de_basses/articles/Earthquake/EARTHQMINIMEFF8/Earthquake-MiniMe-FF8_P_180.jpg' alt='Caisson de basses home cinema Earthquake MiniMe FF8' width='151' height='133'>Quant au choix des enceintes, il doit faire l’objet de nombreuses attentions. Les contraintes du son multicanal sont différentes de celles de la hi-fi. Les écarts dynamiques et le niveau de grave sont bien plus importants et qui décide de se passer d’un caisson de basses devra choisir des enceintes avec des haut-parleurs correctement dimensionnés (13 cm au minimum) et une bonne tenue en puissance. Notez que l’emploi d’un <a title='Caissons de basses pour le home cinema' href='http://www.son-video.com/Rayons/HomeCinema/Sub/CatSub.html'>caisson de basses</a> permet d’utiliser de petites enceintes, puisque les sons graves peuvent être mixés uniquement vers le caisson. Dans l’absolu, un caisson de basses apporte une assise indispensable à l’écoute et renforce le caractère réaliste de vos séances de cinéma. Quant au nombre d’enceintes, il doit être au minimum de 5 si vous voulez respecter le cahier des charges Dolby et DTS. Les possesseurs de grandes pièces d’écoute pourront porter ce nombre à 11 pour une expérience réellement immersive !</p>
                        <h4>Les chaînes home cinema compactes</h4>
                        <p>Les <a title='Les chaînes home cinema compactes' href='http://www.son-video.com/Rayons/HomeCinema/SystHCComplet/CatSystUCompact.html'>chaînes home cinema compactes</a> sont les championnes de l'intégration. Élégantes et discrètes, elles se composent généralement d'une unité principale qui regroupe l'amplification, le tuner radio et le lecteur multimédia (DVD ou Blu-ray) et d'un pack de 2 à 5 enceintes accompagnées d'un caisson de basses. Si les chaînes home cinema stéréo 2.1 se contentent de simuler un son surround virtuel, les chaîne home cinema 5.1 diffusent un véritable son surround avec une spatialisation précise des effets sur les 5 enceintes.</p>
                        <h4><img class='SVDv3_image_alignGauche' title='Chaîne home cinema Yamaha HTR-4065 / NS-PC210' src='http://www.son-video.com/images/dynamic/Amplificateurs_home_cinema/composes/YAMHTR4065NRYAMNSPC210SUB/Yamaha-HTR-4065_P_180.jpg' alt='Chaîne home cinema Yamaha HTR-4065 / NS-PC210' width='170' height='180'>Les chaînes home cinema composées</h4>
                        <p>Vous rêvez d'une chaîne home cinema dont les performances surpassent celles des chaînes home cinema tout-en-un compactes mais vous ne savez pas quel ampli marier avec quelles enceintes ? Notre sélection de <a title='Chaînes home cinema composées' href='http://www.son-video.com/Rayons/HomeCinema/SystHCComplet/CatSystCol.html'>chaînes home cinéma composées</a> est faites pour vous : nous y avons regroupé les meilleurs associations ampli - enceintes home cinema pour votre plus grand plaisir. Nos fiches conseils sont là pour vous aider à faire le bon choix, mais si le moindre doute persiste, <a title='Contactez-nous' href='https://www.son-video.com/PctCompte/contact'>n'hésitez pas à nous contacter pour obtenir un conseil personnalisé.</a></p>
                        <h4><strong>Passez à la 4D !</strong></h4>
                        <p>Une solution novatrice en matière de <a title='Boutique buttkicker : tous les produits' href='http://www.son-video.com/marque/Buttkicker.html'>caissons de basses est le ButtKicker</a> : un vibreur pour canapé particulièrement efficace et totalement silencieux. Fixé à votre canapé, il le fait vibrer à la mesure de la piste audio, remplace ou épaule un caisson existant. Sensations garanties !</p></div>";

        $page->setDescription($description);
        $manager->persist($page);
//        $manager->flush();
    }


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }

}
