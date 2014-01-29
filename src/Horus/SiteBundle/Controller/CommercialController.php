<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Commercial;
use Horus\SiteBundle\Form\CommercialType;
use Horus\SiteBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class CommercialController
 * @package Horus\SiteBundle\Controller
 */
class CommercialController extends Controller
{

    /**
     * Get a action commerciale
     * @param Commercial $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commercialAction(Commercial $id)
    {
        return $this->render('HorusSiteBundle:Commercial:commercial.html.twig', array('commercial' => $id));
    }

    /**
     * Get all actions commercials
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commercialsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $display = $this->container->get('request')->get('display', 5);

        $commercials = $em->getRepository('HorusSiteBundle:Commercial')->findBy(array(), array('id' => "DESC"));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $commercials,
            $this->get('request')->query->get('page', 1) /*page number*/,
            $display);

        return $this->render('HorusSiteBundle:Commercial:commercials.html.twig', array('commercials' => $pagination));
    }

    /**
     * Create a actions commercial
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createcommercialAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $commercial = new Commercial();

        $form = $this->createForm(new CommercialType(), $commercial);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $commercial->upload();
            $em->persist($commercial);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'action commerciale a bien été ajoutée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'action commerciale ".$commercial->getTitle()." vient d'être crée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Création', 'a crée une action commerciale','glyphicon glyphicon-plus',  $this->generateUrl('horus_site_edit_commercial', array('id' => $commercial->getId())));

            return $this->redirect($this->generateUrl('horus_site_commercials'));
        }

        return $this->render('HorusSiteBundle:Commercial:createcommercial.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    /**
     * Edit a action commerciale
     * @param Commercial $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editcommercialAction(Commercial $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CommercialType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $id->upload();
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'action commerciale a bien été modifiée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'action commerciale ".$id->getTitle()." vient d'être modifiée"
            );
            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Création', 'a edité une action commerciale','glyphicon glyphicon-pencil',  $this->generateUrl('horus_site_edit_commercial', array('id' => $id->getId())));

            return $this->redirect($this->generateUrl('horus_site_commercials'));
        }

        return $this->render('HorusSiteBundle:Commercial:editcommercial.html.twig',
            array(
                'form' => $form->createView(),
                'commercial' => $id,
            )
        );

    }

    /**
     * Remove an action commerciale
     * @param Commercial $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removecommercialAction(Commercial $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'action commerciale ".$id->getTitle()." vient d'être supprimée"
        );

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'action commerciale a bien été supprimée"
        );
        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé une action commerciale','glyphicon glyphicon-remove',  $this->generateUrl('horus_site_commercials'));

        return $this->redirect($this->generateUrl('horus_site_commercials'));
    }

    /**
     * Desactive an action commerciale
     * @param Commercial $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivecommercialAction(Commercial $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'action commerciale a bien été désactivée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'action commerciale ".$id->getTitle()." vient d'être desactivée"
        );
        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Désactivation', 'a désactivé une action commerciale','glyphicon glyphicon-minus-sign',  $this->generateUrl('horus_site_edit_commercial', array('id' => $id->getId())));


        return $this->redirect($this->generateUrl('horus_site_commercials'));
    }

    /**
     * Get Active Commercial
     * @param Commercial $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activecommercialAction(Commercial $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'action commerciale a bien été activée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'action commerciale ".$id->getTitle()." vient d'être activée"
        );
        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé une action commerciale','glyphicon glyphicon-check',  $this->generateUrl('horus_site_edit_commercial', array('id' => $id->getId())));

        return $this->redirect($this->generateUrl('horus_site_commercials'));
    }


}
