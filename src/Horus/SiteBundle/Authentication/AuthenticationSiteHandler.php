<?php

namespace  Horus\SiteBundle\Authentication;

use Symfony\Component\Routing\RouterInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityManager,
    Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface,
    Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface,
    Symfony\Component\Security\Core\Authentication\Token\TokenInterface,
    Symfony\Component\HttpFoundation\Session\Session,
    Symfony\Component\Security\Core\Exception\AuthenticationException,
    Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

use Doctrine\Common\Util\Debug as Debug;

/**
 * Class AuthenticationSiteHandler
 * @package Horus\SiteBundle\Authentication
 */
class AuthenticationSiteHandler implements LogoutSuccessHandlerInterface, AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    protected $router;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Constructor Dependances
     * @param RouterInterface $router
     * @param EntityManager $em
     * @param Session $session 
     */
    public function __construct(RouterInterface $router, EntityManager $em, Session $session) {
        $this->router = $router;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * Method Authentification Sucess
     * @param Request $request
     * @param TokenInterface $token
     * @return \Symfony\Component\HttpFoundation\RedirectResponse 
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        $user = $token->getUser();
        $user->setDateAuth(new \DateTime('now'));
        $this->em->persist($user);
        $this->em->flush();

        $referer = $request->server->get('HTTP_REFERER');
        $referer = $this->router->generate('horus_site_main');
        $this->session->set('place', $user->getVille());

        $this->session->getFlashBag()->add(
            'firstconnect',
            "Bienvenue sur Horus CMF"
        );

        if($referer == 'http://'.$request->getHttpHost().'/login')
            $referer = $this->router->generate('horus_site_main');

        return new RedirectResponse($referer);
    }

    /**
     * Auth Failed
     * @param Request $request
     * @param AuthenticationException $exception
     * @return \Symfony\Component\HttpFoundation\RedirectResponse 
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {


        $referer = $request->headers->get('referer');
        $request->getSession()->setFlash('error', $exception->getMessage());
        return new RedirectResponse($referer);
    }

    /**
     * Logout Params
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onLogoutSuccess(Request $request) {
        // redirect the user to where they were before the login process begun.
        $referer_url = $request->headers->get('referer');

        $referer_url = $this->router->generate('horus_site_main');
        $response = new RedirectResponse($referer_url);
        return $response;
    }

}


?>
