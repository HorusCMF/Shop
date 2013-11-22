<?php

namespace Horus\SiteBundle\Listener;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Horus\SiteBundle\Entity\Administrateur;
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
            $user = $this->context->getToken()->getUser();
            $delay = new \DateTime();
            $delay->setTimestamp(strtotime('5 minutes ago'));

            // Nous vérifions que l'utilisateur est bien du bon type pour ne pas appeler getLastActivity() sur un objet autre objet User
            if ($user instanceof Administrateur && $user->getLastActivity() < $delay) {
                $user->isActiveNow();
                $this->em->flush($user);
            }

        }
    }
}

?>
