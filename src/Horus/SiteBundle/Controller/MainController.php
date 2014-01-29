<?php

namespace Horus\SiteBundle\Controller;

use Doctrine\Common\Util\Debug;
use Horus\SiteBundle\Document\Actions;
use Horus\SiteBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class MainController
 * @package Horus\SiteBundle\Controller
 */
class MainController extends Controller
{

    /**
     * Dashboard Homepage
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

//        $this->email = $this->container->get('email');
//        $this->email->send(null, 'HorusSiteBundle:Mails:welcome.html.twig', "Bienvenue sur Horus", 'julien@meetserious.com', null,
//            array( 'content' => 'coucou sa va?')
//        );

        return $this->render('HorusSiteBundle:Main:index.html.twig');
    }

    /**
     * Search Action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction()
    {
        $request = $this->getRequest();

        $form = $this->createForm(new SearchType());
        $form->handleRequest($request);
        $paginator = $this->get('knp_paginator');

        $paginate_by_page = $this->container->getParameter('paginate_by_page');

        $produits = array();
        $pages = array();
        $categories = array();
        $articles = array();
        $tags = array();
        $familles = array();
        $marques = array();
        $clients = array();

        $finalword = null;

        /**
         * Query variables GET
         */
        $word_arg = $request->query->get('word');
        $products_arg = $request->query->get('produits');
        $categories_arg = $request->query->get('categories');
        $familles_arg = $request->query->get('familles');
        $tags_arg = $request->query->get('tags');
        $pages_arg = $request->query->get('pages');
        $articles_arg = $request->query->get('articles');
        $marques_arg = $request->query->get('marques');
        $clients_arg = $request->query->get('clients');

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Recherche', 'a effectué une recherche sur "' . $word_arg . '"', 'glyphicon glyphicon-search');


        if (!empty($word_arg))
            $finalword = $word_arg;

        /**
         * Finders
         */
        $finderProducts = $this->container->get('fos_elastica.finder.website.produit');
        $finderCategories = $this->container->get('fos_elastica.finder.website.category');
        $finderArticle = $this->container->get('fos_elastica.finder.website.article');
        $finderTags = $this->container->get('fos_elastica.finder.website.tag');
        $finderFamille = $this->container->get('fos_elastica.finder.website.famille');
        $finderPages = $this->container->get('fos_elastica.finder.website.pages');
        $finderMarques = $this->container->get('fos_elastica.finder.website.marques');
        $finderClients = $this->container->get('fos_elastica.finder.website.clients');

        if (!empty($products_arg))
            $produits = $finderProducts->find($finalword);

        $pagination = $paginator->paginate(
            $produits,
            $this->get('request')->query->get('page1', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page1')
        );


        if (!empty($categories_arg))
            $categories = $finderCategories->find($finalword);

        $pagination2 = $paginator->paginate(
            $categories,
            $this->get('request')->query->get('page2', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page2')
        );

        if (!empty($familles_arg))
            $familles = $finderFamille->find($finalword);

        $pagination3 = $paginator->paginate(
            $familles,
            $this->get('request')->query->get('page3', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page3')
        );


        if (!empty($tags_arg))
            $tags = $finderTags->find($finalword);

        $pagination4 = $paginator->paginate(
            $tags,
            $this->get('request')->query->get('page4', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page4')
        );


        if (!empty($pages_arg))
            $pages = $finderPages->find($finalword);

        $pagination6 = $paginator->paginate(
            $pages,
            $this->get('request')->query->get('page5', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page5')
        );


        if (!empty($articles_arg))
            $articles = $finderArticle->find($finalword);

        $pagination7 = $paginator->paginate(
            $articles,
            $this->get('request')->query->get('page6', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page6')
        );


        if (!empty($marques_arg))
            $marques = $finderMarques->find($finalword);

        $pagination8 = $paginator->paginate(
            $marques,
            $this->get('request')->query->get('page7', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page7')
        );


        if (!empty($clients_arg))
            $clients = $finderClients->find($finalword);

        $pagination9 = $paginator->paginate(
            $clients,
            $this->get('request')->query->get('page8', 1) /*page number*/,
            $paginate_by_page,
            array('pageParameterName' => 'page8')
        );

        $vide = false;
        if (empty($produits) && empty($clients) && empty($categories) && empty($familles) && empty($categories) && empty($tags) && empty($pages) && empty($articles) && empty($marques))
            $vide = true;

        return $this->render('HorusSiteBundle:Main:search.html.twig',
            array('form' => $form->createView(),
                'produits' => $pagination,
                'categories' => $pagination2,
                'familles' => $pagination3,
                'tags' => $pagination4,
                'pages' => $pagination6,
                'articles' => $pagination7,
                'marques' => $pagination8,
                'clients' => $pagination9,
                'vide' => $vide,
                'keywords' => $finalword,
            )
        );
    }


    /**
     * Search Action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAjaxAction()
    {
        $request = $this->getRequest();

        $form = $this->createForm(new SearchType());
        $form->handleRequest($request);

        $finalword = null;

        /**
         * Query variables GET
         */
        $word_arg = $request->query->get('query');

        if (!empty($word_arg))
            $finalword = $word_arg;

        /**
         * Finders
         */
        $finderProducts = $this->container->get('fos_elastica.finder.website.produit');
        $finderCategories = $this->container->get('fos_elastica.finder.website.category');
        $finderArticle = $this->container->get('fos_elastica.finder.website.article');
        $finderTags = $this->container->get('fos_elastica.finder.website.tag');
        $finderFamille = $this->container->get('fos_elastica.finder.website.famille');
        $finderPages = $this->container->get('fos_elastica.finder.website.pages');
        $finderMarques = $this->container->get('fos_elastica.finder.website.marques');
        $finderClients = $this->container->get('fos_elastica.finder.website.clients');

        $produits = $finderProducts->find($finalword);
        $categories = $finderCategories->find($finalword);
        $articles = $finderArticle->find($finalword);
        $tags = $finderTags->find($finalword);
        $familles = $finderFamille->find($finalword);
        $pages = $finderPages->find($finalword);
        $marques = $finderMarques->find($finalword);
        $clients = $finderClients->find($finalword);

        $results_final = array();

        if (!empty($produits))
            foreach ($produits as $produit)
                $results_final[] = array('nom' => $produit->getTitle(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'produits' => 'on')));


        if (!empty($categories))
            foreach ($categories as $categorie)
                $results_final[] = array('nom' => $categorie->getName(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'categories' => 'on')));


        if (!empty($articles))
            foreach ($articles as $article)
                $results_final[] = array('nom' => $article->getTitle(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'articles' => 'on')));


        if (!empty($tags))
            foreach ($tags as $tag)
                $results_final[] = array('nom' => $tag->getWord(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'tags' => 'on')));


        if (!empty($familles))
            foreach ($familles as $famille)
                $results_final[] = array('nom' => $famille->getName(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'familles' => 'on')));


        if (!empty($pages))
            foreach ($pages as $page)
                $results_final[] = array('nom' => $page->getName(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'pages' => 'on')));


        if (!empty($marques))
            foreach ($marques as $marque)
                $results_final[] = array('nom' => $marque->getTitle(), 'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'marques' => 'on')));


        if (!empty($clients))
            foreach ($clients as $client)
                $results_final[] = array(
                    'nom' => $client->getFirstname() . " " . $client->getLastname() . " du " . $client->getVille() . "(" . $client->getDepartement() . ")",
                    'url' => $this->generateUrl('horus_search_avanced', array('word' => $finalword, 'clients' => 'on'))
                );


        return new JsonResponse($results_final);

//
//        if (!empty($categories_arg))
//            $categories = $finderCategories->find($finalword);
//
//
//
//        if (!empty($familles_arg))
//            $familles = $finderFamille->find($finalword);
//
//
//
//
//        if (!empty($tags_arg))
//            $tags = $finderTags->find($finalword);
//
//
//        if (!empty($pages_arg))
//            $pages = $finderPages->find($finalword);
//
//
//
//        if (!empty($articles_arg))
//            $articles = $finderArticle->find($finalword);


    }


}
