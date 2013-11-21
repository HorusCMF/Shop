<?php

namespace Horus\SiteBundle\Listener;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Wks\SiteBundle\Entity\Users;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Doctrine\Common\Util\Debug as Debug;


/**
 * Class ActivityListener
 * @package Horus\SiteBundle\Listener
 */
class ActivityListener
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    protected $context;
    /**
     * @var object
     */
    protected $em;
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param SecurityContext $context
     * @param Doctrine $doctrine
     * @param ContainerInterface $container
     */
    public function __construct(SecurityContext $context, Doctrine $doctrine, ContainerInterface $container)
    {
        $this->context = $context;
        $this->em = $doctrine->getManager();
        $this->container = $container;
    }

    /**
     * Update the user "lastActivity" on each request
     * @param FilterControllerEvent $event
     */
    public function onCoreController(FilterControllerEvent $event)
    {
        // ici nous vérifions que la requête est une "MASTER_REQUEST" pour que les sous-requête soit ingoré (par exemple si vous faites un render() dans votre template)
        if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST) {
            return;
        }

        // Nous vérifions qu'un token d'autentification est bien présent avant d'essayer manipuler l'utilisateur courant.
        if ($this->context->getToken()) {
//            $this->context->setToken(null);
//            exit(Debug::dump($this->context->getToken()));


            /**
             * Notifications publiques
             */
            $user = $this->context->getToken()->getUser();

            $request = $this->container->get('request');
            $routeName = $request->get('_route');
            $plages = array('site_users_rdv', 'site_users_offer', 'site_user', 'site_partenaires_profil','site_users_rdv_participate' ,'site_users_offer_participate', 'site_users_rdv_add_comm', 'site_users_offers_add_comm', 'site_users_partenaire_add_comm', 'site_partenaire_add_favoris','site_users_friends_confirm', 'site_rdv_create_step2');


        }
    }
}

?>
