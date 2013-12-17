<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Category;
use Horus\SiteBundle\Entity\Commentaire;
use Horus\SiteBundle\Entity\Famille;
use Horus\SiteBundle\Entity\ImageCategory;
use Horus\SiteBundle\Form\CategoryType;
use Horus\SiteBundle\Form\CommentaireType;
use Horus\SiteBundle\Form\FamilleType;
use Horus\SiteBundle\Form\ImageCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CommentairesController
 * @package Horus\SiteBundle\Controller
 */
class CommentairesController extends Controller
{

    /**
     * All Commentaires
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commentairesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commentaires = $em->getRepository('HorusSiteBundle:Commentaire')->findAll();

        return $this->render('HorusSiteBundle:Commentaires:commentaires.html.twig', array('commentaires' => $commentaires));
    }

    /**
     * Last Commentaires
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lastcommentairesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commentaires = $em->getRepository('HorusSiteBundle:Commentaire')->findAll(array(), array('dateCreated' => 'DESC'), 7);

        return $this->render('HorusSiteBundle:Commentaires:lastcommentaires.html.twig', array('commentaires' => $commentaires));
    }

    /**
     * Get a Commentaire
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commentaireAction(Commentaire $id)
    {
        return $this->render('HorusSiteBundle:Commentaires:commentaires.html.twig', array('commentaire' => $id));
    }


    /**
     * Remove a commentaire
     * @param Commentaires $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removecommentaireAction(Commentaire $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le commentaire vient d'être supprimée"
        );

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le commentaire a bien été supprimée"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un commentaire','glyphicon glyphicon-remove');


        return $this->redirect($this->generateUrl('horus_site_commentaires'));
    }


    /**
     * Create a commentaire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createcommentaireAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $commentaire = new Commentaire();

        $form = $this->createForm(new CommentaireType($id), $commentaire);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($commentaire);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le commentaire a bien été ajoutée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le commentaire vient d'être crée"
            );


            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a crée un commentaire','glyphicon glyphicon-plus');

            return $this->redirect($this->generateUrl('horus_site_commentaires'));
        }

        return $this->render('HorusSiteBundle:Commentaires:createcommentaire.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /**
     * Edit a famille
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editcommentaireAction(Commentaire $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CommentaireType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $id->setDateCreated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le commentaire a bien été editée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le commentaire vient d'être editée"
            );


            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité un commentaire','glyphicon glyphicon-pencil');


            return $this->redirect($this->generateUrl('horus_site_commentaires'));
        }

        return $this->render('HorusSiteBundle:Commentaires:editcommentaire.html.twig',
            array(
                'form' => $form->createView(),
                'commentaire' => $id,
            )
        );
    }

    /**
     * Desactive a commentaire
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactivecommentaireAction(Commentaire $id)
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
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a desactivé un commentaire','glyphicon glyphicon-minus-sign');


        return $this->redirect($this->generateUrl('horus_site_commentaires'));
    }

    /**
     * Active a Category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activecommentaireAction(Commentaire $id)
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
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé un commentaire','glyphicon glyphicon-check');


        return $this->redirect($this->generateUrl('horus_site_commentaires'));
    }


}
