<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Article;
use Hetic\SiteBundle\Entity\Category;
use Hetic\SiteBundle\Entity\Tag;
use Hetic\SiteBundle\Form\ArticleType;
use Hetic\SiteBundle\Form\CategoryType;
use Hetic\SiteBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LayoutController extends Controller
{

    public function mainMenuAction()
    {
        return $this->render('HeticSiteBundle:Default:mainmenu.html.twig');

    }

}
