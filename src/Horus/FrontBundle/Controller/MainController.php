<?php

namespace Horus\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HorusFrontBundle:Main:index.html.twig');
    }
}
