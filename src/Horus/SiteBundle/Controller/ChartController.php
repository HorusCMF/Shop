<?php

namespace Horus\SiteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class LayoutController
 * @package Horus\SiteBundle\Controller
 */
class ChartController extends Controller
{

    public function mainAction()
    {

        return $this->render('HorusSiteBundle:Chart:month.html.twig', array(
            'dt' => array(),
            'dt10'        => array(),
            'dataTable1' => array()
        ));

    }

    public function monthsAction()
    {



        return $this->render('HorusSiteBundle:Chart:month.html.twig', array(
            'dt' => array(),
            'dt10'        => array()
        ));
    }

    public function daysAction()
    {

        return $this->render('HorusSiteBundle:Chart:days.html.twig', array(
        ));
    }

}
