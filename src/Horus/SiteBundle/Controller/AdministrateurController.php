<?php

namespace Horus\SiteBundle\Controller;


use Horus\SiteBundle\Form\AdministrateursType;
use Horus\SiteBundle\Form\ConfigurationType;
use Horus\SiteBundle\Entity\Administrateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Class AdministrateurController
 * @package Horus\SiteBundle\Controller
 */
class AdministrateurController extends Controller
{

    /**
     *  Login Action
     * @return type
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Pages:login.html.twig', array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error
            )
        );
    }

    /**
     *  Configuration
     * @return type
     */
    public function configurationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $configuration = $em->getRepository('HorusSiteBundle:Configuration')->find(1);

        $form = $this->createForm(new ConfigurationType(), $configuration);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em->persist($configuration);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La configuration a été modifiée"
            );

            return $this->redirect($this->generateUrl('horus_site_main'));
        }

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Pages:configuration.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

    /**
     *  All Administrateurs
     * @return type
     */
    public function administrateursAction()
    {
        $em = $this->getDoctrine()->getManager();
        $administrateurs = $em->getRepository('HorusSiteBundle:Administrateur')->findAll();

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:administrateurs.html.twig', array(
                'administrateurs' => $administrateurs
            )
        );
    }

    /**
     *  All Online Administrateurs
     * @return type
     */
    public function onlineAction()
    {
        $em = $this->getDoctrine()->getManager();
        $admins = $em->getRepository('HorusSiteBundle:Administrateur')->findAll();

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:online.html.twig', array('admins' => $admins)
        );
    }

    /**
     * @return type
     */
    public function myaccountAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session =  $this->get('session');

        $administrateur = $this->get('security.context')->getToken()->getUser();

        $form = $this->createForm(new AdministrateursType(), $administrateur);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $ville = $form['ville']->getData();

            $villesproxymite = $em->getRepository('HorusSiteBundle:Villes')->findIdByVilleAndZipcode($ville);
            if (!empty($villesproxymite)) {
                $villesproxymite = $villesproxymite[0];
                $session->set('place', $villesproxymite->getNomVille());
                $administrateur->setVille($villesproxymite->getNomVille());
                $administrateur->setZipcode($villesproxymite->getCodePostal());
                $administrateur->setLongitude($villesproxymite->getLongitude());
                $administrateur->setLatitude($villesproxymite->getLatitude());
            }

            $administrateur->setIp($this->container->get('request')->getClientIp());

            $mdp = $form['password']->getData();

            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
            $newpass = $encoder->encodePassword($mdp, $administrateur->getSalt());
            $administrateur->setPassword($newpass);

            $em->persist($administrateur);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le compte a été modifiée"
            );

            return $this->redirect($this->generateUrl('horus_site_main'));
        }


        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:myaccount.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * Remove a administrateur
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeadministrateurAction(Administrateur $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'administrateur  ".$id->getFirstname()." ".$id->getLastname()." vient d'être supprimée"
        );

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'administrateur a bien été supprimée"
        );

        return $this->redirect($this->generateUrl('horus_site_administrateurs'));
    }


    /**
     * Edit a Administrateur
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editadministrateurAction(Administrateur $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new AdministrateursType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $id->setDateUpdated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'administrateur a bien été editée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'administrateur  ".$id->getFirstname()." ".$id->getLastname()." vient d'être modifié"
            );
            return $this->redirect($this->generateUrl('horus_site_administrateurs'));
        }

        return $this->render('HorusSiteBundle:Administrateurs:editadministrateur.html.twig',
            array(
                'form' => $form->createView(),
                'administrateur' => $id,
            )
        );
    }



    /**
     * Edit a Administrateur
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createadministrateurAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $session =  $this->get('session');

        $administrateur = new Administrateur();

        $form = $this->createForm(new AdministrateursType(), $administrateur);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $administrateur->setDateCreated(new \Datetime('now'));

            $ville = $form['ville']->getData();

            $villesproxymite = $em->getRepository('HorusSiteBundle:Villes')->findIdByVilleAndZipcode($ville);
            if (!empty($villesproxymite)) {
                $villesproxymite = $villesproxymite[0];
                $session->set('place', $villesproxymite->getNomVille());
                $administrateur->setVille($villesproxymite->getNomVille());
                $administrateur->setZipcode($villesproxymite->getCodePostal());
                $administrateur->setLongitude($villesproxymite->getLongitude());
                $administrateur->setLatitude($villesproxymite->getLatitude());
            }

            $administrateur->setIp($this->container->get('request')->getClientIp());

            $mdp = $form['password']->getData();

            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
            $newpass = $encoder->encodePassword($mdp, $administrateur->getSalt());
            $administrateur->setPassword($newpass);


            $em->persist($administrateur);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'administrateur a bien été crée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'administrateur  ".$administrateur->getFirstname()." ".$administrateur->getLastname()." vient d'être crée"
            );
            return $this->redirect($this->generateUrl('horus_site_administrateurs'));
        }

        return $this->render('HorusSiteBundle:Administrateurs:createadministrateur.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /**
     * Relog a Administrateur
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function relogadministrateurAction($username = null)
    {
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'administrateur a bien été switché avec ".$username
        );
        return $this->redirect($this->generateUrl('horus_site_main')."?compte_switch=".$username);
    }


    /**
     * Desactive a Administrateur
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactiveadministrateurAction(Administrateur $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setAccountnonlocked(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'administrateur a bien été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'administrateur  ".$id->getFirstname()." ".$id->getLastname()." vient d'être désactivée"
        );

        return $this->redirect($this->generateUrl('horus_site_administrateurs'));
    }

    /**
     * Active a Administrateur
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activeadministrateurAction(Administrateur $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setAccountnonlocked(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'administrateur a bien été activée"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "L'administrateur  ".$id->getFirstname()." ".$id->getLastname()." vient d'être désactivée"
        );

        return $this->redirect($this->generateUrl('horus_site_administrateurs'));
    }


}
