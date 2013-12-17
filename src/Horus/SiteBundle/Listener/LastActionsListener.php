<?php

namespace Horus\SiteBundle\Listener;

use Horus\SiteBundle\Document\Actions;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

use Doctrine\Common\Util\Debug as Debug;


/**
 * Class LastActionsListener
 * @package Horus\SiteBundle\Listener
 */
class LastActionsListener
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    protected $context;
    /**
     * @var object
     */
    protected $dm;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param SecurityContext $context
     * @param Doctrine $doctrine
     * @param ContainerInterface $container
     */
    public function __construct(SecurityContext $context,  DocumentManager $dm)
    {
        $this->context = $context;
        $this->dm = $dm;
    }

    /**
     * Update the user "lastActivity" on each request
     * @param FilterControllerEvent $event
     */
    public function insertActions($title = 'Dernière action', $content = null, $icon = "glyphicon glyphicon-chevron-right", $link = null)
    {

        // Nous vérifions qu'un token d'autentification est bien présent avant d'essayer manipuler l'utilisateur courant.
        if ($this->context->getToken()) {

            $user = $this->context->getToken()->getUser();

//            foreach($actions as $action){
//                $dm->remove($action);
//                $dm->flush();
//            }
            $title = '<i class="'.$icon.'"></i> '.$title;

            if(!empty($content)){

                if($link)
                    $content = $content . ' <a class="pull-right btn btn-danger btn-xs" href="'.$link.'"><i class="glyphicon glyphicon-circle-arrow-right"></i> Voir</a>';

                $token = sha1($title.$content);
                $action = $this->dm->getRepository('HorusSiteBundle:Actions')->findOneByToken($token);
                if(!$action){
                    $action = new Actions();
                    $action->setTitre($title);
                    $action->setToken($token);
                    $action->setAid($user->getId());
                    $action->setContent($user->getFirstname().' '.$user->getLastname()." ".$content);
                    $this->dm->persist($action);
                    $this->dm->flush();
                }
            }

           return true;
        }
    }
}

?>
