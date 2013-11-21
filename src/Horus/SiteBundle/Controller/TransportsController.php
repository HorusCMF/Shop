<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Article;

use Horus\SiteBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class TransportsController
 * @package Horus\SiteBundle\Controller
 */
class TransportsController extends Controller
{

    /**
     * Index Action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('HorusSiteBundle:Main:index.html.twig');

    }


}
