<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Horus\SiteBundle\Entity\Administrateur;


/**
 * Class LoadProductsDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadAdministrateursDatas implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        /**
         * Load Datas
         */
        $administrateur = new Administrateur();
        $administrateur->setEmail('admin@gmail.com');
        $mdp = 'admin';
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $newpass = $encoder->encodePassword($mdp, $administrateur->getSalt());
        $administrateur->setPassword($newpass);
        $administrateur->setGender(1);
        $administrateur->setEnabled(true);
        $administrateur->setFirstname('Julien');
        $administrateur->setLastname('Boyer');
        $administrateur->setDob(new \DateTime('1988-03-16'));
        $administrateur->setVille('Lyon');
        $administrateur->setDescription('Administrateur du système');
        $administrateur->setZipcode('69002');

        /**
         * Add Group
         */
        $em = $this->container->get('doctrine.orm.entity_manager');
        $group = $em->getRepository('HorusSiteBundle:Group')->find(1);
        $group2 = $em->getRepository('HorusSiteBundle:Group')->find(2);
        $administrateur->addGroup($group);
        $administrateur->addGroup($group2);

        $group->addAdministrateur($administrateur);

        $manager->persist($administrateur);
        $manager->persist($group);
//        $manager->flush();
    }


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}
