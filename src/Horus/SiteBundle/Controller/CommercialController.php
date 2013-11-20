<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Commercial;
use Horus\SiteBundle\Form\CommercialType;
use Horus\SiteBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;


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
        $commercials = $em->getRepository('HorusSiteBundle:Commercial')->findAll();

        return $this->render('HorusSiteBundle:Commercial:commercials.html.twig', array('commercials' => $commercials));
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
            $em->persist($commercial);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'action commerciale a bien été ajoutée"
            );

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
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'action commerciale a bien été modifiée"
            );
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

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'action commerciale a bien été supprimée"
        );

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

        return $this->redirect($this->generateUrl('horus_site_commercials'));
    }


}
