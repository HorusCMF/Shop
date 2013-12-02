<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Fournisseurs;
use Horus\SiteBundle\Entity\Marques;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadFamillesDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadMarquesDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $marque = new Marques();
        $marque->setTitle("Samsung");
        $marque->setDescription("Le Groupe Samsung (hangul : 삼성, hanja : 三星, McCune-Reischauer : Samsŏng, romanisé : Samseong qui signifie « trois étoiles ») est un des principaux chaebol, ces conglomérats coréens constitués de différentes sociétés que lient des relations financières complexes. Plusieurs sociétés importantes s'y rattachent, dont l'entreprise d'électronique Samsung Electronics, connue du grand public par les téléviseurs ou la téléphonie mobile, et l'assureur Samsung Life.");

        $manager->persist($marque);
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
