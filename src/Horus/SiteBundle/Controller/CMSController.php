<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\CommentaireArticle;
use Horus\SiteBundle\Entity\Page;
use Horus\SiteBundle\Entity\Tag;
use Horus\SiteBundle\Form\ArticleType;
use Horus\SiteBundle\Form\PageType;
use Horus\SiteBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Horus\SiteBundle\Entity\Article;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CMSController
 * @package Horus\SiteBundle\Controller
 */
class CMSController extends Controller
{

    /**
     * All tags
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tagsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('HorusSiteBundle:Tag')->findAll();

        $display = $this->container->get('request')->get('display', 5);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tags,
            $this->get('request')->query->get('page', 1) /*Page number*/,
            $display
        );

        return $this->render('HorusSiteBundle:CMS:tags.html.twig', array('tags' => $pagination));
    }

    /**
     * Create a tag
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createtagAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $tag = new Tag();

        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mots = $form['word']->getData();
            $tabmots = explode(';', $mots);

            if(!empty($tabmots)){
                foreach($tabmots as $mot){
                    $tag = new Tag();
                    $tag->setWord($mot);
                    $em->persist($tag);
                    $em->flush();
                }
            }

            $this->get('session')->getFlashBag()->add(
                'success',
                "Le tag a été ajouté"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a crée un tag','glyphicon glyphicon-plus',$this->generateUrl('horus_site_tags'));

            return $this->redirect($this->generateUrl('horus_site_tags'));
        }

        return $this->render('HorusSiteBundle:CMS:createtag.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Edit a tag
     * @param Tag $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edittagAction(Tag $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new TagType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $id->setDateCreated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le tag a été modifié"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité un tag','glyphicon glyphicon-pencil',$this->generateUrl('horus_site_edit_tag', array('id' => $id->getId())));

            return $this->redirect($this->generateUrl('horus_site_tags'));
        }

        return $this->render('HorusSiteBundle:CMS:edittag.html.twig',
            array(
                'form' => $form->createView(),
                'tag' => $id,
            )
        );
    }


    /**
     * All Pages
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pagesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nature = $this->container->get('request')->get('nature', array(1,2,3));
        $pages = $em->getRepository('HorusSiteBundle:Page')->findBy(array('nature' => $nature));
        $isarticle = $em->getRepository('HorusSiteBundle:Page')->isArticle();
        if ((int)$isarticle['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également un article"
            );
        }

        $nbvalider = $em->getRepository('HorusSiteBundle:Page')->getCountValidPages(3);
        $nbvalidating = $em->getRepository('HorusSiteBundle:Page')->getCountValidPages(2);
        $nbnovalidate = $em->getRepository('HorusSiteBundle:Page')->getCountValidPages(1);


        $display = $this->container->get('request')->get('display', 5);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $pages,
            $this->get('request')->query->get('page', 1) /*Page number*/,
            $display
        );

        return $this->render('HorusSiteBundle:CMS:pages.html.twig', array(
            'pages' => $pagination,
            'nbvalider' => $nbvalider,
            'nbvalidating' => $nbvalidating,
            'nbnovalidate' => $nbnovalidate,
        ));
    }

    /**
     * All Articles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articlesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nature = $this->container->get('request')->get('nature', array(1,2,3));
        $articles = $em->getRepository('HorusSiteBundle:Article')->findBy(array('nature' => $nature));

        $isPage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if ((int)$isPage['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }
        $display = $this->container->get('request')->get('display', 5);


        $nbvalider = $em->getRepository('HorusSiteBundle:Article')->getCountValidArticles(3);
        $nbvalidating = $em->getRepository('HorusSiteBundle:Article')->getCountValidArticles(2);
        $nbnovalidate = $em->getRepository('HorusSiteBundle:Article')->getCountValidArticles(1);


        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $articles,
            $this->get('request')->query->get('page', 1) /*Page number*/,
            $display
        );

        return $this->render('HorusSiteBundle:CMS:articles.html.twig', array(
            'articles' => $pagination,
            'nbvalider' => $nbvalider,
            'nbvalidating' => $nbvalidating,
            'nbnovalidate' => $nbnovalidate
        ));
    }


    /**
     * Remove a tag
     * @param Tag $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removetagAction(Tag $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le tag a été supprimé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un tag','glyphicon glyphicon-remove');


        return $this->redirect($this->generateUrl('horus_site_tags'));
    }


    /**
     * In home product
     * @param Image $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ishomeAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();
        $id->setHome(true);
        $em->persist($id);
        $em->flush();
        return new JsonResponse(array('success' => true));
    }

    /**
     * Not in home product
     * @param Image $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function isnothomeAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();
        $id->setHome(false);
        $em->persist($id);
        $em->flush();
        return new JsonResponse(array('success' => true));

    }

    /**
     * Create a article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createarticleAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);

        $isPage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if ((int)$isPage['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        if ($form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'article a été ajouté"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'article ".$article->getTitle()." vient d'être crée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a crée un article','glyphicon glyphicon-plus', $this->generateUrl('horus_site_article', array('id' => $article->getId())));

            return $this->redirect($this->generateUrl('horus_site_articles'));
        }

        return $this->render('HorusSiteBundle:CMS:createarticle.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Edit a article
     * @param Article $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editarticleAction(Article $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ArticleType(), $id);
        $form->handleRequest($request);

        $isPage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if ((int)$isPage['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        if ($form->isValid()) {
            $id->setDateUpdated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'article a été edité"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'article ".$id->getTitle()." vient d'être edité"
            );


            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité un article','glyphicon glyphicon-pencil',  $this->generateUrl('horus_site_article', array('id' => $id->getId())));


            return $this->redirect($this->generateUrl('horus_site_articles'));
        }

        return $this->render('HorusSiteBundle:CMS:editarticle.html.twig',
            array(
                'form' => $form->createView(),
                'article' => $id,
            )
        );

    }

    /**
     * Remove a article
     * @param Article $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removearticleAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'article ".$id->getTitle()." vient d'être supprimé"
        );
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'article a été supprimé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un article','glyphicon glyphicon-remove', $this->generateUrl('horus_site_articles'));

        return $this->redirect($this->generateUrl('horus_site_articles'));
    }


    /**
     * Desactive an article
     * @param Article $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivearticleAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setNature(1);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'article a été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'article ".$id->getTitle()." vient d'être desactivé"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a désactivé un article','glyphicon glyphicon-minus-sign', $this->generateUrl('horus_site_articles'));


        return $this->redirect($this->generateUrl('horus_site_articles'));
    }

    /**
     * Active an article
     * @param Article $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activearticleAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setNature(3);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'article a été activé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'article ".$id->getTitle()." vient d'être activé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé un article','glyphicon glyphicon-check', $this->generateUrl('horus_site_articles'));

        return $this->redirect($this->generateUrl('horus_site_articles'));
    }

    /**
     * Get an article
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articleAction(Page $id)
    {
        return $this->render('HorusSiteBundle:CMS:article.html.twig',
            array(
                'category' => $id,
            )
        );
    }
    /**
     * Get an article
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articlecommentaireAction(Article $id)
    {
        return $this->render('HorusSiteBundle:CMS:articlecommentaires.html.twig',
            array(
                'article' => $id,
                'commentaires' => $id->getCommentaires(),
            )
        );
    }

    /**
     * Create a Page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createPageAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $Page = new Page();

        $idarg = $request->query->get('pageref');
        if(!empty($idarg)){
            $Page = $em->getRepository('HorusSiteBundle:Page')->find($idarg);
        }

        $form = $this->createForm(new PageType(), $Page);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $Page->upload();

            $em->persist($Page);
            $em->flush();


            $this->get('session')->getFlashBag()->add(
                'success',
                "La Page a été ajoutée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "La Page ".$Page->getName()." vient d'être crée"
            );


            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a crée une page','glyphicon glyphicon-plus',$this->generateUrl('horus_site_Page', array('id' => $Page->getId())));


            return $this->redirect($this->generateUrl('horus_site_pages'));
        }

        return $this->render('HorusSiteBundle:CMS:createpage.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }


    /**
     * Remove a Page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removePageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La page ".$id->getName()." vient d'être crée"
        );
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a été supprimée"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé une page','glyphicon glyphicon-remove');


        return $this->redirect($this->generateUrl('horus_site_pages'));
    }


    /**
     * Edit a Page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editpageAction(Page $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PageType(), $id);
        $form->handleRequest($request);

        $Essence = new \fg\Essence\Essence();
        $media = $Essence->embed($id->getVideo(), array(
            'maxwidth' => 400,
            'maxheight' => 200
        ));


        if ($form->isValid()) {
            $id->upload($id->getId());

            $id->setDateCreated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La page a été editée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "La page ".$id->getName()." vient d'être editée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité une page','glyphicon glyphicon-pencil', $this->generateUrl('horus_site_edit_Page', array('id' => $id->getId())));

            return $this->redirect($this->generateUrl('horus_site_pages'));
        }

        return $this->render('HorusSiteBundle:CMS:editpage.html.twig',
            array(
                'form' => $form->createView(),
                'page' => $id,
                'video' => $media

            )
        );

    }

    /**
     * Edit a Page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setNature(1);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a été désactivée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La page ".$id->getName()." vient d'être desactivée"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a désactivé une page','glyphicon glyphicon-minus-sign', $this->generateUrl('horus_site_edit_Page', array('id' => $id->getId())));


        return $this->redirect($this->generateUrl('horus_site_pages'));
    }

    /**
     * Active a Page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activePageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setNature(3);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a été activée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La page ".$id->getName()." vient d'être activée"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé une page','glyphicon glyphicon-check', $this->generateUrl('horus_site_edit_page', array('id' => $id->getId())));


        return $this->redirect($this->generateUrl('horus_site_pages'));
    }

    /**
     * Get a Page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function PageAction(Page $id)
    {
        return $this->render('HorusSiteBundle:CMS:page.html.twig',
            array(
                'category' => $id,
            )
        );
    }



    /**
     * Remove a commentaire
     * @param Commentaires $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removecommentaireAction(CommentaireArticle $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le commentaire a bien été supprimée"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un commentaire d\'article','glyphicon glyphicon-remove');


        return $this->redirect($this->generateUrl('horus_site_article_commentaire', array('id' => $id->getArticle()->getId())));
    }




    /**
     * Desactive a commentaire
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivecommentaireAction(CommentaireArticle $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(1);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La commentaire a bien été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La commentaire vient d'être désactivée"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', "a desactivé un commentaire d'article",'glyphicon glyphicon-minus-sign');


        return $this->redirect($this->generateUrl('horus_site_article_commentaire', array('id' => $id->getArticle()->getId())));
    }

    /**
     * Active a Category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activecommentaireAction(CommentaireArticle $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(3);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le commentaire a bien été activée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le commentaire  vient d'être activée"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé un commentaire d\'article','glyphicon glyphicon-check');


        return $this->redirect($this->generateUrl('horus_site_article_commentaire', array('id' => $id->getArticle()->getId())));
    }



}
