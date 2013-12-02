<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Commandes;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;



/**
 * Class LoadClientsDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadCommandesDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $commande = new Commandes();
        $commande->setContent('Commande de test');
        $commande->setEtat(1);
        $commande->setPaiement(1);
        $commande->setTotalHT(25.6);
        $commande->setTotalTTC(28);
        $commande->setReference('51f65sf4d');

        $em = $this->container->get('doctrine.orm.entity_manager');
        $client = $em->getRepository('HorusSiteBundle:Client')->findOneByEmail('demo@horus.com');
        $transport = $em->getRepository('HorusSiteBundle:Transports')->findOneByTitle('UPS TRansport');

        $commande->setClient($client);
        $commande->setTransport($transport);

        $manager->persist($commande);
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
