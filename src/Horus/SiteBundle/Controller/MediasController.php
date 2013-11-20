<?php

namespace Horus\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MediasController extends Controller
{

    /**
     * Get All Medias
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mediasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $paginate_by_page =  $this->container->getParameter('paginate_by_page');
        
        $medias = $em->getRepository('HorusSiteBundle:Image')->findAll();
        $mediascat = $em->getRepository('HorusSiteBundle:ImageCategory')->findAll();
        $pagination = $paginator->paginate(
            $medias,
            $this->get('request')->query->get('page1', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page1')
        );

        $pagination2 = $paginator->paginate(
            $mediascat,
            $this->get('request')->query->get('page2', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page2')
        );

        return $this->render('HorusSiteBundle:Medias:medias.html.twig', array(
            'medias' => $pagination,
            'mediascat' => $pagination2
        ));
    }


}
