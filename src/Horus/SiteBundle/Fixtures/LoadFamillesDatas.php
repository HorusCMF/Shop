<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Famille;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadFamillesDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadFamillesDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $famille = new Famille();
        $famille->setName("TV, Blue Ray ,Ecran Plasma et LCD  & Home cinéma");
        $famille->setDescription("La chaîne home-cinéma Harman Kardon BDS 877 est un système 5.1 complet avec amplificateur et lecteur Blu-ray, compatible avec la technologie de lecture audio réseau Apple AirPlay. Il est donc très facile de lire la musique d'un iPhone, d'un iPad, d'un iPod touch ou de tout ordinateur utilisant iTunes. La lecture depuis tout smartphone Bluetooth est également permise, ce qui rend cette chaîne compatible avec les appareils Android. Le caisson de basses livré est un modèle sans fil, qui dispose d'un amplificateur intégré, capable de délivrer jusqu'à 200 W à son haut-parleur de 20 cm de diamètre. Ainsi dotée, la chaîne home-cinéma Harman Kardon BDS 877 produit un son solide, notamment dans les basses. L'amplificateur principal peut délivrer 65 W à chacune des cinq enceintes compactes, lesquelles sont équipées de deux haut-parleurs de grave-médium de 75 mm de diamètre, ainsi que d'un tweeter à dôme de 13 mm. Ces enceintes sont par ailleurs livrées avec un système de fixation murale, pour réussir une installation élégante. Le lecteur Blu-ray est compatible avec les films 3D et dispose également de fonctions réseau intéressantes, avec la lecture depuis les serveurs UPnP AV (NAS, partage DLNA Windows) des films HD et des musiques au format MP3 ou WMA. Un port USB permet également de lire les fichiers audio depuis une clé ou un disque dur USB. Autre point fort : l'ergonomie du menu OSD de l'amplificateur qui se montre intuitif et agréable. L'installation de la chaîne home-cinéma Harman Kardon BDS 877 est simple, grâce au système d'autocalibration par microphone EzSet/EQ qui facilite grandement le réglage du niveau de chaque enceinte.");

        $manager->persist($famille);
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
