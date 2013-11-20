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


class CMSController extends Controller
{

    public function tagsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('HorusSiteBundle:Tag')->findAll();
        return $this->render('HorusSiteBundle:CMS:tags.html.twig', array('tags' => $tags));
    }

    public function createtagAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $tag = new Tag();

        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($tag);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "Le tag a bien été ajouté"
                );
                return $this->redirect($this->generateUrl('hetic_site_tags'));
            }
        }
        return $this->render('HorusSiteBundle:CMS:createtag.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    public function edittagAction(Tag $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new TagType(), $id);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($id);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "Le tag a bien été modifié"
                );
                return $this->redirect($this->generateUrl('hetic_site_tags'));
            }
        }
        return $this->render('HorusSiteBundle:CMS:edittag.html.twig',
            array(
                'form' => $form->createView(),
                'tag' => $id,
            )
        );

    }


    public function pagesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $isarticle = $em->getRepository('HorusSiteBundle:Page')->isArticle();
        if((int)$isarticle['nombre'] == 0){
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également un article"
            );
        }

        $pages = $em->getRepository('HorusSiteBundle:Page')->findAll();
        return $this->render('HorusSiteBundle:CMS:pages.html.twig', array('pages' => $pages));
    }

    public function articlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ispage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if((int)$ispage['nombre'] == 0){
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        $articles = $em->getRepository('HorusSiteBundle:Article')->findAll();
        return $this->render('HorusSiteBundle:CMS:articles.html.twig', array('articles' => $articles ));
    }


    public function removetagAction(Tag $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le tag a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('hetic_site_tags'));
    }


    public function createarticleAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $page = new Article();

        $form = $this->createForm(new ArticleType(), $page);
        $form->handleRequest($request);

        $ispage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if((int)$ispage['nombre'] == 0){
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($page);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "L'article a bien été ajouté"
                );
                return $this->redirect($this->generateUrl('hetic_site_articles'));
            }
        }
        return $this->render('HorusSiteBundle:CMS:createarticle.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    public function editarticleAction(Article $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ArticleType(), $id);
        $form->handleRequest($request);

        $ispage = $em->getRepository('HorusSiteBundle:Article')->isPage();
        if((int)$ispage['nombre'] == 0){
            $this->get('session')->getFlashBag()->add(
                'warning',
                "N'oubliez pas de créer également une page"
            );
        }

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $id->setDateUpdated(new \Datetime('now'));
                $em->persist($id);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "L'article a bien été editée"
                );
                return $this->redirect($this->generateUrl('hetic_site_articles'));
            }
        }
        return $this->render('HorusSiteBundle:CMS:editarticle.html.twig',
            array(
                'form' => $form->createView(),
                'article' => $id,
            )
        );

    }


    public function removearticleAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'article a bien été supprimé"
        );
        return $this->redirect($this->generateUrl('hetic_site_articles'));
    }


    public function desactivearticleAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'article a bien été désactivé"
        );
        return $this->redirect($this->generateUrl('hetic_site_articles'));
    }

    public function activearticleAction(Article $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'article a bien été activé"
        );
        return $this->redirect($this->generateUrl('hetic_site_articles'));
    }

    public function articleAction(PAge $id)
    {

        return $this->render('HorusSiteBundle:CMS:article.html.twig',
            array(
                'category' => $id,
            )
        );
    }






    public function createpageAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $page = new Page();

        $form = $this->createForm(new PageType(), $page);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($page);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "La page a bien été ajoutée"
                );
                return $this->redirect($this->generateUrl('hetic_site_pages'));
            }
        }
        return $this->render('HorusSiteBundle:CMS:createpage.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }


    public function removepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a bien été supprimée"
        );
        return $this->redirect($this->generateUrl('hetic_site_pages'));
    }


    public function editpageAction(Page $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new PageType(), $id);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($id);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "La page a bien été editée"
                );
                return $this->redirect($this->generateUrl('hetic_site_pages'));
            }
        }
        return $this->render('HorusSiteBundle:CMS:editpage.html.twig',
            array(
                'form' => $form->createView(),
                'page' => $id,
            )
        );

    }

    public function desactivepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a bien été désactivée"
        );
        return $this->redirect($this->generateUrl('hetic_site_pages'));
    }

    public function activepageAction(Page $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La page a bien été activée"
        );
        return $this->redirect($this->generateUrl('hetic_site_pages'));
    }

    public function pageAction(PAge $id)
    {

        return $this->render('HorusSiteBundle:CMS:page.html.twig',
            array(
                'category' => $id,
            )
        );
    }




}
