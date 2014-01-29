<?php

namespace Horus\SiteBundle\Controller;


use Horus\SiteBundle\Entity\Client;
use Horus\SiteBundle\Form\ClientsAdressesType;
use Horus\SiteBundle\Form\ClientsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Horus\SiteBundle\Entity\Clients;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;


/**
 * Class ClientsController
 * @package Horus\SiteBundle\Controller
 */
class ClientsController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function facturesAction()
    {
        return $this->render('HorusSiteBundle:Commandes:factures.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commandesAction()
    {
        return $this->render('HorusSiteBundle:Commandes:commandes.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commentairesAction()
    {
        return $this->render('HorusSiteBundle:Clients:commentaires.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function clientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('HorusSiteBundle:Client')->findAll();
        $display = $this->container->get('request')->get('display', 5);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $clients,
            $this->get('request')->query->get('page', 1) /*page number*/,
            $display
        );

        return $this->render('HorusSiteBundle:Clients:clients.html.twig', array('clients' => $pagination));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lastclientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('HorusSiteBundle:Client')->findAll(array(), array('cateCreated' => 'DESC', 7));
        return $this->render('HorusSiteBundle:Clients:lastclients.html.twig', array('clients' => $clients));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function clientAction(Client $id)
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('HorusSiteBundle:Clients:client.html.twig', array('client' => $id));
    }

    /**
     * Get Commandes of Client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commandesclientAction(Client $id)
    {
        $display = $this->container->get('request')->get('display', 5);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $id->getCommandes(),
            $this->get('request')->query->get('page', 1) /*page number*/,
            $display
        );

        return $this->render('HorusSiteBundle:Clients:clientcommande.html.twig',
            array(
                'client' => $id,
                'commandes' => $pagination
            ));
    }

    /**
     * Get Commandes of Client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function adressesclientAction(Client $id)
    {

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ClientsAdressesType(), $id);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $adresses = $id->getAddresses();
            if (!empty($adresses))
                foreach ($adresses as $adresse) {
                    $adresse->setClient($id);
                }

            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'adresse du client a été modifiée"
            );

            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "L'adresse du client ".$id->getFirstname()." ".$id->getLastname()." vient d'être modifiée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Edition', "a modifié l'adresse d'un client",'glyphicon glyphicon-pencil');

            return $this->redirect($this->generateUrl('horus_site_clients'));
        }

            return $this->render('HorusSiteBundle:Clients:adresses.html.twig',
            array(
                'client' => $id,
                'addresses' => $id->getAddresses(),
                'form' => $form->createView()
            ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function panierclientAction(Client $id)
    {
        return $this->render('HorusSiteBundle:Clients:panierclient.html.twig',
            array(
                'client' => $id,
                'panier' => $id->getCart()
            ));
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function seeclientAction(Client $id)
    {
        return $this->render('HorusSiteBundle:Clients:client.html.twig',
            array(
                'client' => $id,
                'addresses' => $id->getAddresses()
            ));
    }

    /**
     * Create a Client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createclientAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $session = $this->container->get('session');

        $client = new Client();

//        //Get Geolocalisation
//        if (empty($place)) {
//            exec(sprintf('python ../py/ipcoordonate4.py %s', $_SERVER['REMOTE_ADDR']), $result);
//            if (empty($result))
//                exec(sprintf('python ../py/ipcoordonate2.py %s', $_SERVER['REMOTE_ADDR']), $result);
//            if (empty($result))
//                exec(sprintf('python ../py/ipcoordonate.py %s', $_SERVER['REMOTE_ADDR']), $result);
//
//            if (!empty($result))
//                $session->set('place', $result[0]);
//        }

        $form = $this->createForm(new ClientsType(), $client);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $ville = $form['ville']->getData();

            $villesproxymite = $em->getRepository('HorusSiteBundle:Villes')->findIdByVilleAndZipcode($ville);
            if (!empty($villesproxymite)) {
                $villesproxymite = $villesproxymite[0];
                $session->set('place', $villesproxymite->getNomVille());
                $client->setVille($villesproxymite->getNomVille());
                $client->setZipcode($villesproxymite->getCodePostal());
                $client->setLongitude($villesproxymite->getLongitude());
                $client->setLatitude($villesproxymite->getLatitude());
            }

            $client->setIp($this->container->get('request')->getClientIp());

            $mdp = $form['password']->getData();

            if(!empty($mdp)){
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $newpass = $encoder->encodePassword($mdp, $client->getSalt());
                $client->setPassword($newpass);
            }

            $em->persist($client);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le client a bien été ajoutée"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le client " . $client->getFirstname() . " " . $client->getLastname() . " vient d'être crée"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a ajouté un client','glyphicon glyphicon-plus', $this->generateUrl('horus_site_client', array('id' => $client->getId())));


            return $this->redirect($this->generateUrl('horus_site_clients'));
        }

        return $this->render('HorusSiteBundle:Clients:createclient.html.twig', array('form' => $form->createView()));
    }


    /**
     * Create a Client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editclientAction(Client $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $session = $this->container->get('session');

//        //Get Geolocalisation
//        if (empty($place)) {
//            exec(sprintf('python ../py/ipcoordonate4.py %s', $_SERVER['REMOTE_ADDR']), $result);
//            if (empty($result))
//                exec(sprintf('python ../py/ipcoordonate2.py %s', $_SERVER['REMOTE_ADDR']), $result);
//            if (empty($result))
//                exec(sprintf('python ../py/ipcoordonate.py %s', $_SERVER['REMOTE_ADDR']), $result);
//
//            if (!empty($result))
//                $session->set('place', $result[0]);
//        }

        $form = $this->createForm(new ClientsType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $ville = $form['ville']->getData();

            $villesproxymite = $em->getRepository('HorusSiteBundle:Villes')->findIdByVilleAndZipcode($ville);
            if (!empty($villesproxymite)) {
                $villesproxymite = $villesproxymite[0];
                $session->set('place', $villesproxymite->getNomVille());
                $id->setVille($villesproxymite->getNomVille());
                $id->setZipcode($villesproxymite->getCodePostal());
                $id->setLongitude($villesproxymite->getLongitude());
                $id->setLatitude($villesproxymite->getLatitude());
            }

            $id->setIp($this->container->get('request')->getClientIp());

            $mdp = $form['password']->getData();

            if (!empty($mdp)) {
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $newpass = $encoder->encodePassword($mdp, $id->getSalt());
                $id->setPassword($newpass);
            }

            $id->setDateUpdated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Le client a bien été modifié"
            );
            $this->get('session')->getFlashBag()->add(
                'messagerealtime',
                "Le client " . $id->getFirstname() . " " . $id->getLastname() . " vient d'être modifié"
            );

            /**
             * Notifications
             */
            $this->container->get('lastactions_listener')->insertActions('Creation', 'a edité un client','glyphicon glyphicon-pencil', $this->generateUrl('horus_site_client', array('id' => $id->getId())));

            return $this->redirect($this->generateUrl('horus_site_clients'));
        }

        return $this->render('HorusSiteBundle:Clients:editclient.html.twig', array('form' => $form->createView(), 'client' => $id));
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeclientAction(Client $id)
    {
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le client " . $id->getFirstname() . " " . $id->getLastname() . " vient d'être supprimée"
        );

        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le client a bien été supprimé"
        );

        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Suppression', 'a supprimé un client','glyphicon glyphicon-remove');

        return $this->redirect($this->generateUrl('horus_site_clients'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paniersAction()
    {
        return $this->render('HorusSiteBundle:Commandes:panier.html.twig');
    }


    /**
     * Desactive a category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function desactiveclientAction(Client $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setEnabled(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "Le client a bien été désactivé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le client " . $id->getFirstname() . " " . $id->getLastname() . " vient d'être désactivé"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Desactivation', 'a désactivé un client','glyphicon glyphicon-minus-sign', $this->generateUrl('horus_site_client', array('id' => $id->getId())));

        return $this->redirect($this->generateUrl('horus_site_clients'));
    }

    /**
     * Active a Category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activeclientAction(Client $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setEnabled(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La client a bien été activé"
        );
        $this->get('session')->getFlashBag()->add(
            'messagerealtime',
            "Le client " . $id->getFirstname() . " " . $id->getLastname() . " vient d'être activé"
        );


        /**
         * Notifications
         */
        $this->container->get('lastactions_listener')->insertActions('Activation', 'a activé un client','glyphicon glyphicon-check', $this->generateUrl('horus_site_client', array('id' => $id->getId())));

        return $this->redirect($this->generateUrl('horus_site_clients'));
    }

}
