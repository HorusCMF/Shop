<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Article;
use Horus\SiteBundle\Entity\Category;
use Horus\SiteBundle\Entity\Tag;
use Horus\SiteBundle\Form\ArticleType;
use Horus\SiteBundle\Form\CategoryType;
use Horus\SiteBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('HorusSiteBundle:Default:index.html.twig');

    }
    public function productsAction()
    {
        return $this->render('HorusSiteBundle:Default:products.html.twig');

    }
    public function loginAction()
    {
        return $this->render('HorusSiteBundle:Default:login.html.twig');

    }

    public function dashboardAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $article = new Article();
        $form = $this->createForm(new ArticleType($article), $article);
        $form->handleRequest($request);

//        $paginator  = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//            $articles,
//            $this->get('request')->query->get('page', 1)/*page number*/,
//            3/*limit per page*/
//        );

        /**
         * If Is Post
         */
        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    "L'article a bien été ajouté en base !"
                );
                return $this->redirect($this->generateUrl('hetic_site_hello'));
            }
        }

        return $this->render('HorusSiteBundle:Default:dashboard.html.twig',
            array('form' => $form->createView())
        );

    }


}
