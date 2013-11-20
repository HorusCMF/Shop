<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Article;
use Hetic\SiteBundle\Entity\Category;
use Hetic\SiteBundle\Entity\Tag;
use Hetic\SiteBundle\Form\ArticleType;
use Hetic\SiteBundle\Form\CategoryType;
use Hetic\SiteBundle\Form\SearchType;
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
            'HeticSiteBundle:Default:login.html.twig', array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error
            )
        );
    }


}
