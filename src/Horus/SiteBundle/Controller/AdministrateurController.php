<?php

namespace Horus\SiteBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

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

}
