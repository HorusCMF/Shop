<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Transports;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadTransportsDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadTransportsDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $transporteur = new Transports();
        $transporteur->setTitle('UPS TRansport');
        $transporteur->setContent("UPS (abréviation de United Parcel Service) (NYSE : UPS) est une entreprise postale dont le siège est à Atlanta. Elle est surnommée la « Big Brown », allusion à la couleur du costume des employés (brun, qui se dit brown en anglais). Le quartier général pour l'Europe, le Moyen-Orient et l'Afrique est situé à Bruxelles, en Belgique.");

        $manager->persist($transporteur);
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
