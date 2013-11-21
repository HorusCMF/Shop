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
class ChartController extends Controller
{

    public function mainAction()
    {
        return $this->render('HorusSiteBundle:Chart:main.html.twig');

    }

}
