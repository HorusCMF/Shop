<?php

namespace Horus\SiteBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *  Controller listener
 */
class ResponseListener {

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * 
     */
    public function __construct(ContainerInterface $container, \Symfony\Component\Templating\EngineInterface $interface) {
        $this->container = $container;
        $this->templating = $interface;
    }

    /**
     *  On Kernel Request
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event) {
//        $request = $event->getRequest();
//        // Redirect By Geo
//        $this->user = $this->container->get('security.context')->getToken()->getUser();
//        $zipcode = substr($this->user->getZipcode(), 0, 2);
//        $allowed_dep = array('91', '92', '93', '77', '78', '75', '94', '95');
//        if (!in_array($zipcode, $allowed_dep)) {
//            $html = $this->templating->render('SiteBundle:Statics:geo2.html.twig');
//            $response = new Response($html);
//            $event->setResponse($response);
//        }
    }

}

?>
