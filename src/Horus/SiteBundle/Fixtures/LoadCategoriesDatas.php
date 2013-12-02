<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Category;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadCategoriesDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadCategoriesDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $category = new Category();
        $category->setName("TV & Home cinéma");
        $category->setDescription("Découvrez toutes les nouvelles technologies 3D, Connectée sur une large sélection de TV LCD, LED ou Plasma. Retrouvez aussi nos Vidéoprojecteurs, Home Cinéma, Lecteur et Enregistreur vidéo.");

//        $manager->persist($category);
//        $manager->flush();

        $category = new Category();
        $category->setName("Tablettes tactiles");
        $category->setDescription("En stock.
                            Expédié et vendu par Amazon. Emballage cadeau disponible.
                            Voulez-vous le faire livrer le mardi 3 décembre ? Commandez-le dans les 1 h et 1 min  et choisissez la livraison en 1 jour ouvré sur votre bon de commande. En savoir plus.
                            Vous commandez pour Noël? Pour une livraison garantie d'ici le 24 décembre , sélectionnez Rapide lorsque vous passerez votre commande. En savoir plus sur les livraisons pendant les fêtes.
                            Ecran 10.1 TFT
                            Disque dur: 16 Go
                            Processeur: 1 GHz
                            Système d'exploitation: Android Ice Cream Sandwich 4.0
                            Poids: 588 gr");

        $manager->persist($category);
        $manager->flush();

    }


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }

}
