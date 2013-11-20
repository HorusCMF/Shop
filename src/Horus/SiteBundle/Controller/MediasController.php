<?php

namespace Horus\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MediasController extends Controller
{

    public function mediasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $medias = $em->getRepository('HorusSiteBundle:Image')->findAll();
        $mediascat = $em->getRepository('HorusSiteBundle:ImageCategory')->findAll();
        $pagination = $paginator->paginate(
            $medias,
            $this->get('request')->query->get('page1', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page1')
        );

        $pagination2 = $paginator->paginate(
            $mediascat,
            $this->get('request')->query->get('page2', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page2')
        );


        return $this->render('HorusSiteBundle:Medias:medias.html.twig', array(
            'medias' => $pagination,
            'mediascat' => $pagination2
        ));
    }


}
