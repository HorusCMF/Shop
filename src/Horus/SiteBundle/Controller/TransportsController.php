<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Transports;
use Horus\SiteBundle\Form\TransportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class TransportsController
 * @package Horus\SiteBundle\Controller
 */
class TransportsController extends Controller
{


    /**
     * Get All Transports
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function transportsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $transports = $em->getRepository('HorusSiteBundle:Transports')->findAll();

        return $this->render('HorusSiteBundle:Transports:transports.html.twig',
            array('transports' => $transports)
        );
    }


    /**
     * Create a product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createtransportAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $transport = new Transports();

        $form = $this->createForm(new TransportType(), $transport);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $transport->upload();
            $em->persist($transport);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le transport a été crée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le transport ".$transport->getTitle()." vient d'être crée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Création', 'a crée un transport','glyphicon glyphicon-plus', $this->generateUrl('horus_site_edit_transport', array('id' => $transport->getId())));


            return $this->redirect($this->generateUrl('horus_site_transports'));
        }

        return $this->render('HorusSiteBundle:Transports:createtransport.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }


    /**
     * Create a product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edittransportAction(Transports $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new TransportType($id), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $id->upload();
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le transporteur a été modifié"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le transporteur ".$id->getTitle()." vient d'être modifié"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité un transport','glyphicon glyphicon-pencil', $this->generateUrl('horus_site_edit_transport', array('id' => $id->getId())));

            return $this->redirect($this->generateUrl('horus_site_transports'));
        }

        return $this->render('HorusSiteBundle:Transports:edittransport.html.twig',
            array(
                'form' => $form->createView(),
                'transport' => $id
            )
        );

    }


    /**
     * Remove a transport
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removetransportAction(Transports $id)
    {
        $em = $this->getDoctrine()->getManager();

        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le transport ".$id->getTitle()." vient d'être supprimé"
        );

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le transport a été supprimé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppresion', 'a supprimé un transport','glyphicon glyphicon-remove');


        return $this->redirect($this->generateUrl('horus_site_transports'));
    }


    /**
     * Desactive a product
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivetransportAction(Transports $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le transport a été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le transport ".$id->getTitle()." a été desactivé"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a desactivé un transport','glyphicon glyphicon-minus-sign', $this->generateUrl('horus_site_edit_transport', array('id' => $id->getId())));

        return $this->redirect($this->generateUrl('horus_site_transports'));
    }

    /**
     * Active a product
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activetransportAction(Transports $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le transport a été activé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le transport ".$id->getTitle()." a été activé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a desactivé un transport','glyphicon glyphicon-check', $this->generateUrl('horus_site_edit_transport', array('id' => $id->getId())));


        return $this->redirect($this->generateUrl('horus_site_transports'));
    }

}
