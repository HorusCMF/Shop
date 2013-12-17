<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Image;
use Horus\SiteBundle\Entity\ImageFournisseurs;
use Horus\SiteBundle\Entity\Fournisseurs;

use Horus\SiteBundle\Form\FournisseursType;
use Horus\SiteBundle\Form\ImageFournisseursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class FournisseursController
 * @package Horus\SiteBundle\Controller
 */
class FournisseursController extends Controller
{

    /**
     * All Fournisseurs
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function fournisseursAction()
    {
        $em = $this->getDoctrine()->getManager();
        $fournisseurs = $em->getRepository('HorusSiteBundle:Fournisseurs')->findAll();
        $paginate_by_page = $this->container->getParameter('paginate_by_page');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $fournisseurs,
            $this->get('request')->query->get('page', 1) /*page number*/,
            $paginate_by_page
        );

        return $this->render('HorusSiteBundle:Fournisseurs:fournisseurs.html.twig', array('fournisseurs' => $pagination));
    }

    /**
     * Remove a fournisseur
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removefournisseurAction(Fournisseurs $id)
    {
        $em = $this->getDoctrine()->getManager();

        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le fournisseur ".$id->getTitle()." vient d'être supprimé"
        );

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La fournisseur a été supprimé"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un fournisseur','glyphicon glyphicon-remove');


        return $this->redirect($this->generateUrl('horus_site_fournisseurs'));
    }

    /**
     * Remove image of fournisseur
     * @param Image $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeimagefournisseurAction(ImageFournisseurs $id)
    {
        $em = $this->getDoctrine()->getManager();
        $fournisseur = $id->getFournisseur();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'image du fournisseur a été activée"
        );

        return $this->redirect($this->generateUrl('horus_site_edit_pictures_fournisseurs', array('id' => $fournisseur->getId())));
    }

    /**
     * Cover image of fournisseur
     * @param Image $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function coverimagefournisseurAction(ImageFournisseurs $id)
    {
        $em = $this->getDoctrine()->getManager();
        $fournisseur = $id->getFournisseur();

        /**
         * Handle Old Images
         */
        $oldsimage = $fournisseur->getImages();
        if (!empty($oldsimage))
            foreach ($oldsimage as $img) {
                $img->setCover(false);
                $em->persist($img);
                $em->flush();
            }
        $id->setCover(true);
        $em->persist($id);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            "L'image du fournisseur a été mise en avant"
        );

        return $this->redirect($this->generateUrl('horus_site_edit_pictures_fournisseurs', array('id' => $id->getFournisseur()->getId())));
    }

    /**
     * Add picture of fournisseur
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function picturefournisseurAction(Fournisseurs $id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $image = new ImageFournisseurs();
        $image->setFournisseur($id);
        $form = $this->createForm(new ImageFournisseursType(), $image);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $image->upload($id->getId());
            $em->persist($image);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'image du fournisseur a été ajoutée"
            );
            return new JsonResponse(true);
        }

        return $this->render('HorusSiteBundle:Fournisseurs:picturefournisseur.html.twig',
            array(
                'form' => $form->createView(),
                'fournisseur' => $id
            )
        );
    }

    /**
     * Desactive a fournisseur
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivefournisseurAction(Fournisseurs $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setActive(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le fournisseur a été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le fournisseur ".$id->getTitle()." a été desactivé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a desactivé un fournisseur','glyphicon glyphicon-minus-sign', $this->generateUrl('horus_site_edit_fournisseurs', array('id' => $id->getId())));



        return $this->redirect($this->generateUrl('horus_site_fournisseurs'));
    }

    /**
     * Active a fournisseur
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activefournisseurAction(Fournisseurs $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setActive(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le fournisseur a été activé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le fournisseur ".$id->getTitle()." a été activé"
        );

        return $this->redirect($this->generateUrl('horus_site_fournisseurs'));
    }

    /**
     * Create a fournisseur
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createfournisseurAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $fournisseur = new Fournisseurs();

        $form = $this->createForm(new FournisseursType(), $fournisseur);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $fournisseur->upload();
            $em->persist($fournisseur);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le fournisseur a été crée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le fournisseur vient d'être crée"
            );


            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Création', 'a crée un fournisseur','glyphicon glyphicon-plus', $this->generateUrl('horus_site_edit_fournisseurs', array('id' => $fournisseur->getId())));


            return $this->redirect($this->generateUrl('horus_site_edit_pictures_fournisseurs', array('id' => $fournisseur->getId())));
        }

        return $this->render('HorusSiteBundle:Fournisseurs:createfournisseur.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    /**
     * Edit a fournisseur
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editfournisseurAction(Fournisseurs $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new FournisseursType($id), $id);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $id->upload($id->getId());
            $id->setDateUpdated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le fournisseur a été edité"
            );

            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le fournisseur ".$id->getTitle()." vient d'être modifié"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a edité un fournisseur','glyphicon glyphicon-pencil', $this->generateUrl('horus_site_edit_fournisseurs', array('id' => $id->getId())));


            return $this->redirect($this->generateUrl('horus_site_fournisseurs'));
        }

        return $this->render('HorusSiteBundle:Fournisseurs:editfournisseur.html.twig',
            array(
                'form' => $form->createView(),
                'fournisseur' => $id
            )
        );

    }


}
