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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function transportsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $transports = $em->getRepository('HorusSiteBundle:Transport')->findAll();

        return $this->render('HorusSiteBundle:Clients:transports.html.twig',
            array('transports' => $transports)
        );
    }



}
