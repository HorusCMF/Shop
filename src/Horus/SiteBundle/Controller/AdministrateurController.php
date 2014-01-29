<?php

namespace Horus\SiteBundle\Controller;


use Horus\SiteBundle\Document\Actions;
use Horus\SiteBundle\Document\Messagerie;
use Horus\SiteBundle\Form\AdministrateursType;
use Horus\SiteBundle\Form\ConfigurationType;
use Horus\SiteBundle\Entity\Administrateur;
use Horus\SiteBundle\Form\ContactType;
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
        $em = $this->getDoctrine()->getManager();

//        $administrateur = $em->getRepository('HorusSiteBundle:Administrateur')->find(21);
//        $mdp = 'djscrave';
//
//        if(!empty($mdp)){
//            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
//            $newpass = $encoder->encodePassword($mdp, $administrateur->getSalt());
//            $administrateur->setPassword($newpass);
//        }
//        $em->persist($administrateur);
//        $em->flush();

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

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Configuration', 'a édité la configuration','glyphicon glyphicon-cog');


            return $this->redirect($this->generateUrl('horus_site_main'));
        }

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Pages:configuration.html.twig', array(
                'form' => $form->createView(),
                'configuration' => $configuration
            )
        );
    }

    /**
     * Statistiques
     * @return type
     */
    public function infosAction()
    {

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Slots:infos.html.twig', array(
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
     *  All last messages of administrateurs
     * @return type
     */
    public function lastmessagerieAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

//        $message = new Messagerie();
//        $message->setDescription('ok');
//        $message->setTitle('ok');
//        $dm->persist($message);
//        $dm->flush();

//        $messages = $dm->getRepository('HorusSiteBundle:Messagerie')->findAll();
        $messages = $dm->getRepository('HorusSiteBundle:Messagerie')->findBy(array(), array('_id' => 'DESC'), 15);

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:lastmessages.html.twig', array('messages' => $messages)
        );
    }

    /**
     *  All last messages of administrateurs
     * @return type
     */
    public function allmessagerieAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $messages = $dm->getRepository('HorusSiteBundle:Messagerie')->findBy(array(), array('dateCreated' => 'DESC'));

        $display = $this->container->get('request')->get('display', 15);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $messages->toArray(),
            $this->get('request')->query->get('page', 1) /*page number*/,
            $display
        );

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:allmessages.html.twig', array('messages' => $pagination)
        );
    }

    /**
     *  All last actions of administrateurs
     * @return type
     */
    public function lastactionsAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('HorusSiteBundle:Actions')->findBy(array(), array('dateCreated' => 'DESC'), 5);

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:lastactions.html.twig', array('actions' => $actions)
        );
    }

    /**
     *  All actions of administrateurs
     * @return type
     */
    public function allactionsAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('HorusSiteBundle:Actions')->findBy(array(), array('dateCreated' => 'DESC'));
        $display = $this->container->get('request')->get('display', 15);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $actions->toArray(),
            $this->get('request')->query->get('page', 1) /*page number*/,
            $display
        );

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:allactions.html.twig', array('actions' => $pagination)
        );
    }


    /**
     *  Last notify of administrateurs
     * @return type
     */
    public function lastnotifyAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $notifs = $dm->getRepository('HorusSiteBundle:Notifications')->findBy(array(), array('dateCreated' => 'DESC'), 5);

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:lastnotify.html.twig', array('notifications' => $notifs)
        );
    }


    /**
     *  All actions of administrateurs
     * @return type
     */
    public function allnotificationsAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $notifs = $dm->getRepository('HorusSiteBundle:Notifications')->findBy(array(), array('dateCreated' => 'DESC'));
        $display = $this->container->get('request')->get('display', 15);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $notifs->toArray(),
            $this->get('request')->query->get('page', 1) /*page number*/,
            $display
        );

        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:allnotifications.html.twig', array('notifs' => $pagination)
        );
    }

    /**
     *  All actions of  one administrateur
     * @return type
     */
    public function allactionsbyadministratorsAction(Administrateur $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('HorusSiteBundle:Actions')->findBy(array('aid' => $id->getId()), array('dateCreated' => 'DESC'));
        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:allactionsbyadministrateurs.html.twig',
            array(
                'actions' => $actions,
                'administrateur' => $id,
            )
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

        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('HorusSiteBundle:Actions')->findBy(array('aid' => $administrateur->getId()), array('dateCreated' => 'DESC'), 5);

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
            $administrateur->upload($administrateur->getId());
            $administrateur->setUpdatedAt(new \Datetime('now'));
            $administrateur->setIp($this->container->get('request')->getClientIp());

            $mdp = $form['password']->getData();

            if(!empty($mdp)){
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $newpass = $encoder->encodePassword($mdp, $administrateur->getSalt());
                $administrateur->setPassword($newpass);
            }

            $em->persist($administrateur);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le compte a été modifiée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité son compte','glyphicon glyphicon-user');


            return $this->redirect($this->generateUrl('horus_site_myaccount'));
        }


        return $this->get('templating')->renderResponse(
            'HorusSiteBundle:Administrateurs:myaccount.html.twig',
            array(
                'form' => $form->createView(),
                'actions' => $actions,
            )
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

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un administrateur','glyphicon glyphicon-remove');

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

        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('HorusSiteBundle:Actions')->findBy(array('aid' => $id->getId()), array('dateCreated' => 'DESC'), 5);

        if ($form->isValid()) {
            $id->upload($id->getId());
            $id->setUpdatedAt(new \Datetime('now'));
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

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', 'a édité un administrateur','glyphicon glyphicon-pencil');


            return $this->redirect($this->generateUrl('horus_site_administrateurs'));
        }

        return $this->render('HorusSiteBundle:Administrateurs:editadministrateur.html.twig',
            array(
                'form' => $form->createView(),
                'administrateur' => $id,
                'actions' => $actions,
            )
        );
    }



    /**
     * Write a Administrateur
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function writeadministrateurAction(Administrateur $id)
    {
        $request = $this->getRequest();

        $form = $this->createForm(new ContactType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $subject = $form['subject']->getData();
            $content = $form['content']->getData();
            $criticite = $form['criticite']->getData();

            $this->email = $this->container->get('email');
            $this->email->send(null, 'HorusSiteBundle:Mails:writeadministrateur.html.twig', "Un administrateur vous a ecrit un message ".$subject, $id->getEmail(), null,
                array( 'content' => $content), null, null, null, $criticite
            );
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'email à l'administrateur a bien été envoyé"
            );
            return $this->redirect($this->generateUrl('horus_site_administrateurs'));
        }

        return $this->render('HorusSiteBundle:Administrateurs:writeadministrateur.html.twig',
            array(
                'form' => $form->createView(),
                'administrateur' => $id,
            )
        );
    }



    /**
     * Add a Administrateur
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
            $administrateur->upload($administrateur->getId());

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

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a crée un administrateur','glyphicon glyphicon-plus');


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

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Switch', 'a basculé sous un autre administrateur','glyphicon glyphicon-transfer');


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

        $id->setEnabled(false);
        $id->setAccountnonlocked(true);
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

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a désactivé un administrateur','glyphicon glyphicon-minus-sign');


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

        $id->setEnabled(true);
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

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé un administrateur','glyphicon glyphicon-plus');


        return $this->redirect($this->generateUrl('horus_site_administrateurs'));
    }


}
