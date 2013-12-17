<?php

namespace Horus\SiteBundle\Controller;


use Horus\SiteBundle\Document\Actions;
use Horus\SiteBundle\Form\AdministrateursType;
use Horus\SiteBundle\Form\ConfigurationType;
use Horus\SiteBundle\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class NotificationsController
 * @package Horus\SiteBundle\Controller
 */
class NotificationsController extends Controller
{

    /**
     *  Get Produits
     * @return type
     */
    public function getNotificationProduit()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('HorusSiteBundle:Actions')->findBy(array(), array('dateCreated' => 'DESC'), 5);

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:lastactions.html.twig', array('actions' => $actions)
        );
    }



}
