<?php

namespace Horus\SiteBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Class PreMethodListener
 * @package MyFuckinJob\SiteBundle\Listener
 */
class PreMethodListener {


    /**
     * 
     * @param FilterControllerEvent $event 
     */
    public function onCoreController(FilterControllerEvent $event) {
        if (HttpKernelInterface::MASTER_REQUEST != $event->getRequestType()) {
            $_controller = $event->getController();
            if (isset($_controller[0])) {
                $controller = $_controller[0];
                if (method_exists($controller, 'preExecute')) {
                    $controller->preExecute();
                }
            }
        }
    }

//    protected $securityContext;
////
//  
//    /**
//     * 
//     * @param GetResponseEvent $event
//     * @return type 
//     */
//    public function onKernelRequest(GetResponseEvent $event)
//    {
//        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
//            return;
//        }
//          $request = $event->getRequest();
//        /* @var $request \Symfony\Component\HttpFoundation\Request */
// 
//        if ($request->getRequestFormat() == 'json') {
//            $event->setResponse(new Response('We have no response for a JSON request', 501));
//        }
//    }
//     /**
//      * In this entry, we will create a service that will act as an Exception Listener, allowing us to modify how exceptions are shown by our application
//      * @param GetResponseForExceptionEvent $event 
//      */
//     public function onKernelException(GetResponseForExceptionEvent $event)
//    {
//        // We get the exception object from the received event
//        $exception = $event->getException();
//        $message = 'My Error says: ' . $exception->getMessage();
//
//        // Customize our response object to display our exception details
//        $response = new Response();
//        $response->setContent($message);
//        $response->setStatusCode($exception->getStatusCode());
//
//        // Send our modified response object to the event
//        $event->setResponse($response);
//    }
//    public function postPersist(LifecycleEventArgs $args)
//    {
//        $entity = $args->getEntity();
////        $user =  $this->securityContext->getToken()->getUser();
//
//        /**
//         * Persist After suscribe meets 
//         */
//        if ($entity instanceof Meets) {
////            exit('la');
//            exit(print_r($user->getFirstName()));
////            $notification = new Notification();
//            
//        }
//    }
}

?>
