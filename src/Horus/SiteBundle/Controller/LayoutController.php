<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Article;
use Horus\SiteBundle\Entity\Category;
use Horus\SiteBundle\Entity\Tag;
use Horus\SiteBundle\Form\ArticleType;
use Horus\SiteBundle\Form\CategoryType;
use Horus\SiteBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class LayoutController
 * @package Horus\SiteBundle\Controller
 */
class LayoutController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mainMenuAction()
    {
        return $this->render('HorusSiteBundle:Slots:mainmenu.html.twig');
    }

    /**
     * Custom Theme
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function themeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $configuration = $em->getRepository('HorusSiteBundle:Configuration')->find(1);
        return $this->render('HorusSiteBundle:Slots:theme.html.twig', array('configuration' => $configuration));
    }


    /**
     * get Ip Visitor
     * @return type
     */
    public function getIpVisitorAction()
    {
        $ip = $this->container->get('request')->getClientIp();
        return $this->container->get('templating')->renderResponse('HorusSiteBundle:Slots:_ipVisitor.html.twig', array(
            'ip' => $ip
        ));
    }
}
