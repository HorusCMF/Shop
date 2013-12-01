<?php

namespace Horus\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HorusFrontBundle:Default:index.html.twig', array('name' => $name));
    }
}
