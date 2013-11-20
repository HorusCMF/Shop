<?php

namespace Hetic\SiteBundle\Controller;

use Doctrine\Common\Util\Debug;
use Hetic\SiteBundle\Entity\Article;

use Hetic\SiteBundle\Form\ArticleType;
use Hetic\SiteBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

class MainController extends Controller
{


    public function indexAction()
    {
        return $this->render('HeticSiteBundle:Default:index.html.twig');

    }

    public function productsAction()
    {
        return $this->render('HeticSiteBundle:Default:products.html.twig');

    }

    public function loginAction()
    {
        return $this->render('HeticSiteBundle:Default:login.html.twig');

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

        return $this->render('HeticSiteBundle:Default:dashboard.html.twig',
            array('form' => $form->createView())
        );

    }


    public function searchAction()
    {
        $form = $this->createForm(new SearchType());
        return $this->render('HeticSiteBundle:Default:search_partial.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    public function advancedsearchAction()
    {
        $request = $this->getRequest();

        $form = $this->createForm(new SearchType());
        $form->handleRequest($request);


        $produits = array();
        $pages = array();
        $categories = array();
        $articles = array();
        $tags = array();
        $familles = array();

        $finalword = null;

        $word_arg = $request->query->get('word');
        $products_arg = $request->query->get('produits');
        $categories_arg = $request->query->get('categories');
        $familles_arg = $request->query->get('familles');
        $tags_arg = $request->query->get('tags');
        $pages_arg = $request->query->get('pages');
        $articles_arg = $request->query->get('articles');

        if (!empty($word_arg))
            $finalword = $word_arg;


        $finderProducts = $this->container->get('fos_elastica.finder.website.produit');
        $finderCategories = $this->container->get('fos_elastica.finder.website.category');
        $finderArticle = $this->container->get('fos_elastica.finder.website.article');
        $finderTags = $this->container->get('fos_elastica.finder.website.tag');
        $finderFamille = $this->container->get('fos_elastica.finder.website.famille');
        $finderPages = $this->container->get('fos_elastica.finder.website.pages');

        if (!empty($products_arg))
            $produits = $finderProducts->find($finalword);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $produits,
            $this->get('request')->query->get('page1', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page1')
        );


        if (!empty($categories_arg))
            $categories = $finderCategories->find($finalword);

        $paginator2 = $this->get('knp_paginator');
        $pagination2 = $paginator2->paginate(
            $categories,
            $this->get('request')->query->get('page2', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page2')
        );


        if (!empty($familles_arg))
            $familles = $finderFamille->find($finalword);

        $paginator3 = $this->get('knp_paginator');
        $pagination3 = $paginator3->paginate(
            $familles,
            $this->get('request')->query->get('page3', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page3')
        );


        if (!empty($tags_arg))
            $tags = $finderTags->find($finalword);


        $paginator4 = $this->get('knp_paginator');
        $pagination4 = $paginator4->paginate(
            $tags,
            $this->get('request')->query->get('page4', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page4')
        );


        if (!empty($pages_arg))
            $pages = $finderPages->find($finalword);

        $paginator6 = $this->get('knp_paginator');
        $pagination6 = $paginator6->paginate(
            $pages,
            $this->get('request')->query->get('page5', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page5')
        );


        if (!empty($articles_arg))
            $articles = $finderArticle->find($finalword);

        $paginator7 = $this->get('knp_paginator');
        $pagination7 = $paginator7->paginate(
            $articles,
            $this->get('request')->query->get('page6', 1) /*page number*/,
            2/*limit per page*/,
            array('pageParameterName' => 'page6')
        );


        return $this->render('HeticSiteBundle:Default:search.html.twig',
            array('form' => $form->createView(),
                'produits' => $pagination,
                'categories' => $pagination2,
                'familles' => $pagination3,
                'tags' => $pagination4,
                'pages' => $pagination6,
                'articles' => $pagination7,
            )
        );
    }


}
