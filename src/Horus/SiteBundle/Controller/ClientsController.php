<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Article;

use Horus\SiteBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class ClientsController
 * @package Horus\SiteBundle\Controller
 */
class ClientsController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('HorusSiteBundle:Main:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function facturesAction()
    {
        return $this->render('HorusSiteBundle:Clients:factures.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commandesAction()
    {
        return $this->render('HorusSiteBundle:Clients:commandes.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commentairesAction()
    {
        return $this->render('HorusSiteBundle:Clients:commentaires.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function clientsAction()
    {
        return $this->render('HorusSiteBundle:Clients:clients.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paniersAction()
    {
        return $this->render('HorusSiteBundle:Clients:panier.html.twig');
    }


}
