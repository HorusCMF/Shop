<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Page;
use Horus\SiteBundle\Entity\Tag;
use Horus\SiteBundle\Form\ArticleType;
use Horus\SiteBundle\Form\PageType;
use Horus\SiteBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Horus\SiteBundle\Entity\Article;

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

        return $this->render('HorusSiteBundle:CMS:tags.html.twig', array('tags' => $tags));
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
            $em->persist($tag);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le tag a été ajouté"
            );

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
     * All pages
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pagesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('HorusSiteBundle:Page')->findAll();
        $isarticle = $em->getRepository('HorusSiteBundle:Page')->isArticle();
        if ((int)$isarticle['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également un article"
            );
        }

        return $this->render('HorusSiteBundle:CMS:pages.html.twig', array('pages' => $pages));
    }

    /**
     * All Articles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articlesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('HorusSiteBundle:Article')->findAll();
        $ispage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if ((int)$ispage['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        return $this->render('HorusSiteBundle:CMS:articles.html.twig', array('articles' => $articles));
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

        return $this->redirect($this->generateUrl('horus_site_tags'));
    }


    /**
     * Create a article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createarticleAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $page = new Article();
        $form = $this->createForm(new ArticleType(), $page);
        $form->handleRequest($request);

        $ispage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if ((int)$ispage['nombre'] == 0) {
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        if ($form->isValid()) {
            $em->persist($page);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'article a été ajouté"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'article ".$page->getTitle()." vient d'être crée"
            );
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

        $ispage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if ((int)$ispage['nombre'] == 0) {
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

        $id->setIsVisible(false);
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

        $id->setIsVisible(true);
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
        return $this->redirect($this->generateUrl('horus_site_articles'));
    }

    /**
     * Get an article
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articleAction(PAge $id)
    {
        return $this->render('HorusSiteBundle:CMS:article.html.twig',
            array(
                'category' => $id,
            )
        );
    }

    /**
     * Create a page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createpageAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $page = new Page();

        $form = $this->createForm(new PageType(), $page);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($page);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La page a été ajoutée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "La page ".$page->getName()." vient d'être crée"
            );
            return $this->redirect($this->generateUrl('horus_site_pages'));
        }

        return $this->render('HorusSiteBundle:CMS:createpage.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }


    /**
     * Remove a page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La page ".$id->getTitle()." vient d'être crée"
        );
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a été supprimée"
        );

        return $this->redirect($this->generateUrl('horus_site_pages'));
    }


    /**
     * Edit a page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editpageAction(Page $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PageType(), $id);
        $form->handleRequest($request);


        if ($form->isValid()) {
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
            return $this->redirect($this->generateUrl('horus_site_pages'));
        }

        return $this->render('HorusSiteBundle:CMS:editpage.html.twig',
            array(
                'form' => $form->createView(),
                'page' => $id,
            )
        );

    }

    /**
     * Edit a page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a été désactivée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La page ".$id->getTitle()." vient d'être desactivée"
        );
        return $this->redirect($this->generateUrl('horus_site_pages'));
    }

    /**
     * Active a page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a été activée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "La page ".$id->getTitle()." vient d'être activée"
        );
        return $this->redirect($this->generateUrl('horus_site_pages'));
    }

    /**
     * Get a page
     * @param Page $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pageAction(PAge $id)
    {
        return $this->render('HorusSiteBundle:CMS:page.html.twig',
            array(
                'category' => $id,
            )
        );
    }


}
