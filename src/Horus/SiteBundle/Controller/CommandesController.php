<?php

namespace Horus\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CommandesController
 * @package Horus\SiteBundle\Controller
 */
class CommandesController extends Controller
{
    public function indexAction()
    {
        return $this->render('HorusSiteBundle:Main:index.html.twig');
    }
}
