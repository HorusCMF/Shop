<?php
$I = new WebGuy($scenario);
$I->wantTo('Je suis sur la home');
$I->amOnPage('/');
$em = $I->grabServiceFromContainer('doctrine');


//$I->dontSeeInCurrentUrl('/users/');
//$I->dontSeeLink('Logout');
//$I->seeCurrentUrlEquals('/');

//
////$i->sendAjaxPostRequest
////$i->sendAjaxGetRequest
//$I->submitForm('#addarticle',
//    array(
//        'title' => 'Hello les copains!',
//        'content' => 'Coucou sa va?',
//        'category' => 3,
//        'isVisible' => true,
//        'point' => 15,
//        'datePublication' => '2014-12-10',
//        'nature' => 'Final',
//        'tags' => array(1,5),
//    ));
//$errors = $I->grabTextFrom('.alert');
//$I->expect($errors);


//
//$I->submitForm('#addcategory',
//    array(
////        'name' => 'Nouvelle Caté!',
////        'description' => 'Coucou je suis la description',
////        'articles' => array(27,28),
////    ));
////$errors = $I->grabTextFrom('.alert');
////$I->expect($errors);
//$I->seeInCurrentUrl('/');
//
/**
 * Database
 */
//$category = $em->getEntityManager()->getRepository('HeticSiteBundle:Category')->find(1);
//$I->expect($category->getName());


/**
 * Peristence one Article
 */
//$article = new \Hetic\SiteBundle\Entity\Article();
//$article->setTitle("C'est un essai!");
//$em = $em->getManager();
//$em->persist($article);



//$em->flush();
//
//
///**
// * Request
// */
//$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
//$I->expect($request->getMethod());
//
//
///**
// * Session
// */
//$session = new \Symfony\Component\HttpFoundation\Session\Session();
//
//// définit et récupère des attributs de session
//$session->set('name', 'Drak');
//$name = $session->get('name', 'Juju');
//
//$I->expect($name);
//
//
///**
// * Session
// */
//$session = new \Symfony\Component\HttpFoundation\Session\Session();
//
//// définit et récupère des attributs de session
//$session->set('name', 'Drak');
//$name = $session->get('name', 'Juju');
//
//$I->expect($name);
//
////$I->seeLink('Petit lien vers 404');
//$I->seeLink('A La Une');
////$I->click('#action_cates a:first-child');
//$I->click('#action_cates a:nth-child(3)');
//$I->see("Gérard De Villiers,");
//$I->click("Gérard De Villiers,");
//$url = $I->grabFromCurrentUrl();
//$I->expect($url);
//
//$I->see("Gérard De Villiers,");
//$I->see("Date de publication de l'article: 20-11-2013");
//$I->see("Lilian Thuram");
//
//
///**
// * Back home
// */
//$I->amOnPage('/');
//$I->see('Sécurité Routière : Souriez ! Vous Êtes Flashés - Le Retour');
//
//
///**
// * Remove an Article
// */
//$I->see('<i class="icon-star"></i>');
//$I->click('.remove:nth-child(1)');
//$I->seeLink('.btn')   ;





