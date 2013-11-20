<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Commercial;
use Hetic\SiteBundle\Form\CommercialType;
use Hetic\SiteBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;


class CommercialController extends Controller
{

    public function commercialAction(Commercial $id)
    {
        return $this->render('HeticSiteBundle:Commercial:commercial.html.twig', array('commercial' => $id));
    }

    public function commercialsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commercials = $em->getRepository('HeticSiteBundle:Commercial')->findAll();
        return $this->render('HeticSiteBundle:Commercial:commercials.html.twig', array('commercials' => $commercials));
    }

    public function createcommercialAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $commercial = new Commercial();

        $form = $this->createForm(new CommercialType(), $commercial);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($commercial);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "L'action commerciale a bien été ajoutée"
                );
                return $this->redirect($this->generateUrl('hetic_site_commercials'));
            }
        }
        return $this->render('HeticSiteBundle:Commercial:createcommercial.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    public function editcommercialAction(Commercial $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new CommercialType(), $id);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($id);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "L'action commerciale a bien été modifiée"
                );
                return $this->redirect($this->generateUrl('hetic_site_commercials'));
            }
        }
        return $this->render('HeticSiteBundle:Commercial:editcommercial.html.twig',
            array(
                'form' => $form->createView(),
                'commercial' => $id,
            )
        );

    }

    public function removecommercialAction(Commercial $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'action commerciale a bien été supprimée"
        );
        return $this->redirect($this->generateUrl('hetic_site_commercials'));
    }


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
        return $this->redirect($this->generateUrl('hetic_site_commercials'));
    }

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
        return $this->redirect($this->generateUrl('hetic_site_commercials'));
    }


}
