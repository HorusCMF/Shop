<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Article;

use Hetic\SiteBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

class CommandesController extends Controller
{

    public function indexAction()
    {
        return $this->render('HeticSiteBundle:Default:index.html.twig');

    }


}
