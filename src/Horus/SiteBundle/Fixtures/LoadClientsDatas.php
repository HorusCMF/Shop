<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Client;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;



/**
 * Class LoadClientsDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadClientsDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
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
        $client = new Client();
        $client->setGender(1);
        $client->setFirstname('Julien');
        $client->setLastname('Boyer');
        $client->setEmail('demo@horus.com');
        $client->setVille('Lyon');
        $client->setDescription('Client Alpha');
        $client->setDob(new \DateTime('1988-05-08'));
        $client->setZipcode('75002');
        $client->setEnabled(true);
        $mdp = 'demo';
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $newpass = $encoder->encodePassword($mdp, $client->getSalt());
        $client->setPassword($newpass);

        $manager->persist($client);
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
