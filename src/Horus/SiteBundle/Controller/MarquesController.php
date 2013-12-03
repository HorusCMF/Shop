<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Image;
use Horus\SiteBundle\Entity\Marques;
use Horus\SiteBundle\Entity\ImageMarques;

use Horus\SiteBundle\Form\ImageMarquesType;
use Horus\SiteBundle\Form\MarquesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class MarquesController
 * @package Horus\SiteBundle\Controller
 */
class MarquesController extends Controller
{

    /**
     * All Marques
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function marquesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $marques = $em->getRepository('HorusSiteBundle:Marques')->findAll();
        $paginate_by_page = $this->container->getParameter('paginate_by_page');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $marques,
            $this->get('request')->query->get('page', 1) /*page number*/,
            $paginate_by_page
        );

        return $this->render('HorusSiteBundle:Marques:marques.html.twig', array('marques' => $pagination));
    }

    /**
     * Remove a marque
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removemarqueAction(Marques $id)
    {
        $em = $this->getDoctrine()->getManager();

        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le marque ".$id->getTitle()." vient d'être supprimée"
        );

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La marque a été supprimée"
        );

        return $this->redirect($this->generateUrl('horus_site_marques'));
    }

    /**
     * Remove image of marque
     * @param Image $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeimagemarqueAction(ImageMarques $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'image de la marque a été activée"
        );

        return $this->redirect($this->generateUrl('horus_site_edit_pictures_marques', array('id' => $id->getMarque()->getId())));
    }

    /**
     * Cover image of marque
     * @param Image $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function coverimagemarqueAction(ImageMarques  $id)
    {
        $em = $this->getDoctrine()->getManager();
        $marque = $id->getMarque();

        /**
         * Handle Old Images
         */
        $oldsimage = $marque->getImages();
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
            "L'image de la marque a été mise en avant"
        );

        return $this->redirect($this->generateUrl('horus_site_edit_pictures_marques', array('id' => $id->getMarque()->getId())));
    }

    /**
     * Add picture of marque
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function picturemarqueAction(Marques $id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $image = new ImageMarques();
        $image->setMarque($id);
        $form = $this->createForm(new ImageMarquesType(), $image);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $isfirst = $em->getRepository('HorusSiteBundle:ImageMarques')->isFirstImage($id);
            if ((int)$isfirst['nombre'] == 0)
                $image->setCover(true);

            $image->upload($id->getId());
            $em->persist($image);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'image de la marque a été ajoutée"
            );
            return new JsonResponse(true);
        }

        return $this->render('HorusSiteBundle:Marques:picturemarque.html.twig',
            array(
                'form' => $form->createView(),
                'marque' => $id
            )
        );
    }

    /**
     * Desactive a marque
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivemarqueAction(Marques $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le produit a été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le produit ".$id->getTitle()." a été desactivé"
        );


        return $this->redirect($this->generateUrl('horus_site_marques'));
    }

    /**
     * Active a marque
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activemarqueAction(Marques $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setIsVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le produit a été activé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le produit ".$id->getTitle()." a été activé"
        );

        return $this->redirect($this->generateUrl('horus_site_marques'));
    }

    /**
     * Create a marque
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createmarqueAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $marque = new Marques();

        $form = $this->createForm(new MarquesType(), $marque);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $marque->upload();
            $em->persist($marque);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La marque a été crée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "La marque vient d'être crée"
            );
            return $this->redirect($this->generateUrl('horus_site_edit_pictures_marques', array('id' => $marque->getId())));
        }

        return $this->render('HorusSiteBundle:Marques:createmarque.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    /**
     * Edit a marque
     * @param Produit $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editmarqueAction(Marques $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new MarquesType($id), $id);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $id->upload();
            $id->setDateUpdated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le produit a été edité"
            );

            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le produit ".$id->getTitle()." vient d'être modifié"
            );
            return $this->redirect($this->generateUrl('horus_site_marques'));
        }

        return $this->render('HorusSiteBundle:Marques:editmarque.html.twig',
            array(
                'form' => $form->createView(),
                'marque' => $id
            )
        );

    }


}
