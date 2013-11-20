<?php
//use \WebGuy;
//
//class CestAddArticleCest
//{
//
//    public function _before()
//    {
//        print('*************************************  Debut du Scenario Hetic Application  ****************************************');
//    }
//
//    public function _after()
//    {
//        print('*************************************  Fin du Scenario Hetic Application  ****************************************');
//    }
//
//    public function onHome(WebGuy $I) {
//        $I->wantTo('Aller sur la home');
//        $I->amOnPage('/');
//        $I->seeElement('h2');
//        $I->dontSeeInCurrentUrl('/users/');
//        $I->dontSeeLink('Logout');
//        $I->seeCurrentUrlEquals('/');
//        $I->seeInCurrentUrl('/');
//    }
//
//    public function persistOnArticle(WebGuy $I) {
//        $I->wantTo('Enregistrer un article');
//        $em = $I->grabServiceFromContainer('doctrine');
//        $category = $em->getRepository('HeticSiteBundle:Category')->find(1);
//        $I->expect($category->getName());
//        $article = new \Hetic\SiteBundle\Entity\Article();
//        $article->setTitle("C'est un essai!");
//        $em = $em->getManager();
//        $em->persist($article);
//    }
//
//    public function addAnArticle(WebGuy $I) {
//        $I->wantTo('Ajouter un article depuis la home');
//
//        $I->amOnPage('/');
//        $content = "Contenu de mon article test";
//
//        $I->submitForm('form',
//            array(
//                'title' => 'Ici le titre de mon article de test',
//                'content' => $content,
//                'category' => 1,
//                'isVisible' => true,
//                'point' => 8,
//                'datePublication' => '2015-05-07',
//                'nature' => 1,
//                'tags' => array(10),
//            ));
//        $errors = $I->grabTextFrom('.alert');
//        $I->expect($errors);
//
//    }
//
//    public function addAnCategory(WebGuy $I) {
//        $I->wantTo('Ajouter une category depuis la home');
//
//        $I->amOnPage('/');
//
//        $content = "Contenu de ma category test";
//        $I->submitForm('#addcategory',
//            array(
//                'name' => 'New Caté !',
//                'description' => $content,
//                'articles' => array(25,28),
//            ));
//        $errors = $I->grabTextFrom('.alert');
//        $I->expect($errors);
//    }
//
//    public function getInCategory(WebGuy $I) {
//        $I->wantTo('Etre dans une category');
//
//        $I->amOnPage('/');
//        $I->click('table tr:nth-child(3) td:nth-child(3) a');
//        $I->see("Sports extremes");
//        $I->see("le Dr Muller acquitté");
//    }
//
//    public function modifyOnArticle(WebGuy $I) {
//        $I->wantTo('Modifier une category depuis la home');
//
//        $I->amOnPage('/');
//        $I->click('table tr:nth-child(3) .edit');
//        $I->see("Editer mon article");
//        $url = $I->grabFromCurrentUrl();
//        $I->expect($url);
//
//        //$i->sendAjaxPostRequest
//        //$i->sendAjaxGetRequest
//        $content = "La cour d'assises de Meurthe-et-Moselle a acquitté jeudi le docteur Jean-Louis Muller de l'accusation de meurtre de sa femme en 1999. Il comparaissait pour la troisième fois dans cette affaire, après avoir été condamné à deux reprises à 20 ans de prison. ";
//        $I->submitForm('form',
//            array(
//                'title' => 'Près de Nancy : le Dr Muller acquitté du meurtre de sa femme',
//                'content' => $content,
//                'category' => 4,
//                'isVisible' => true,
//                'point' => 10,
//                'datePublication' => '2014-12-10',
//                'nature' => 2,
//                'tags' => array(5,8,11,16),
//            ));
//        $errors = $I->grabTextFrom('.alert');
//        $I->expect($errors);
//
//    }
//
//    public function visibleAnArticle(WebGuy $I) {
//        $I->wantTo('Rendre visibe/invisible un article');
//
//        $I->amOnPage('/');
//        $I->click('table tr:nth-child(2) .visible');
//    }
//
//    public function morePointAnArticle(WebGuy $I) {
//        $I->wantTo('Ajouter un point à un article');
//
//        $I->amOnPage('/');
//        $I->click('table tr:nth-child(2) .plus');
//        $I->click('table tr:nth-child(3) .less');
//    }
//
//    public function naviguateOnArticle(WebGuy $I) {
//        $I->wantTo('Naviguer sur un article');
//
//        $I->amOnPage('/');
//        $I->seeLink('A La Une');
//        $I->click('#action_cates a:nth-child(3)');
//        $I->see("Gérard De Villiers,");
//        $I->click("Gérard De Villiers,");
//        $url = $I->grabFromCurrentUrl();
//        $I->expect($url);
//
//        $I->see("Gérard De Villiers,");
//        $I->see("Date de publication de l'article: 20-11-2013");
//        $I->see("Lilian Thuram");
//    }
//
//    public function editACategory(WebGuy $I) {
//        $I->wantTo('Editer une category');
//
//        $I->amOnPage('/category/3');
//        $I->see('A La Une');
//        $I->click('Editer');
//        $I->submitForm('form',
//            array(
//                'name' => 'A la une',
//                'description' => 'A la deux',
//                'articles' => array(47),
//            ));
//        $errors = $I->grabTextFrom('.alert');
//        $I->expect($errors);
//    }
//
//    public function clickOnTag(WebGuy $I) {
//        $I->amOnPage('sort-by-category/4');
//        $I->see('A La Une');
////        $this->assertTrue(true);
//    }
//
//    public function removeAnArticle(WebGuy $I) {
//        $I->wantTo('Supprimer un article');
//
//        $I->amOnPage('/');
//        $I->see('Sécurité Routière : Souriez ! Vous Êtes Flashés - Le Retour');
////        $I->click('table tr:nth-child(4) .remove');
//    }
//
//}