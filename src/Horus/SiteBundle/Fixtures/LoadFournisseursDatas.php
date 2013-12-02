<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Fournisseurs;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadFamillesDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadFournisseursDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $fournisseur = new Fournisseurs();
        $fournisseur->setTitle("Darty Entrepots");
        $fournisseur->setDescription("Darty est une entreprise française de magasins spécialisés dans la vente d'électroménager, de matériels informatiques et audiovisuels (télévision et audio), filiale de la société Kesa Electricals PLC. L'enseigne communique en promouvant son Service Après-Vente, et ne manque pas d'associer sa marque avec son slogan fétiche, « le contrat de confiance ».");

        $manager->persist($fournisseur);
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
