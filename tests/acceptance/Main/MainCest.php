<?php
use \WebGuy;

class MainCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

    /**
     * On Home
     * @param WebGuy $I
     */
    public function onHome(WebGuy $I)
    {
        $I->wantTo('on Home');
        $I->amOnPage('/');
        $I->see('Authentification');
        $I->see('Souvenir de moi');
        $I->amOnPage('/backend');
        $I->see('Authentification');
        $I->see('Souvenir de moi');

    }

    /**
     * On Failure Login
     * @param WebGuy $I
     */
    public function onFailureAuthentificate(WebGuy $I)
    {
        $I->wantTo('on Failure Auth');
        $I->amOnPage('/');
        $I->see('Authentification');
        $I->submitForm('form',
            array(
                '_username' => 'bidon@free.fr',
                '_password' => 'djscrave',
            ));
        $errors = $I->grabTextFrom('.alert');
        $I->expect($errors);
    }

    /**
     * On Success Auth
     * @param WebGuy $I
     */
    public function onSuccessAuthentificate(WebGuy $I)
    {
        $I->wantTo('on Success Authentificate');
        $I->amOnPage('/');
        $I->see('Authentification');
        $I->submitForm('form',
            array(
                '_username' => 'zuzu38080@gmail.com',
                '_password' => 'djscrave',
            ));
        $I->amOnPage('/backend');
        $I->see('Modern Solution for E-Commerce for Minimalist Operations');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onProducts(WebGuy $I)
    {
        $I->wantTo('In Products Page');
        $I->amOnPage('/backend/produits');
        $I->see('Vos produits');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateProducts(WebGuy $I)
    {
        $I->wantTo('In Products Create Page');
        $I->amOnPage('/backend/produits/creer');
        $I->see('Créer un produit');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateProcessFailureProducts(WebGuy $I)
    {
        $I->wantTo('In Products Create Page');
        $I->amOnPage('/backend/produits/creer');
        $I->see('Créer un produit');
        $I->submitForm('form#createproduct',
            array(
                'accroche' => 'o',
                'reference' => 'ok',
                'ean' => 'ok',
                'prixHT' => 'ok',
                'seo[0][title]' => 'ok',
                'prixTTC' => 'ok',
            ));
        $errors = $I->grabTextFrom('.alert');
        $I->see('Le titre ne doit pas etre vide');
        $I->see('Le résumé ne doit pas etre vide');
        $I->see('La description ne doit pas etre vide');
//        $I->see("Le prix HT n'est pas valide");
//        $I->see("Le prix TTC n'est pas valide");
        $I->see("référencement doit faire au moins 5 caractères");
        $I->see('Votre accroche doit faire au moins 5 caractères');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateProcessSuccessProducts(WebGuy $I)
    {
        $I->wantTo('In Products Create Page');
        $I->amOnPage('/backend/produits/creer');
        $I->see('Créer un produit');
        $I->submitForm('form#createproduct',
            array(
                'title' => "Galaxy Note 8.0 - Tablette Tactile 8'' Capacitif - Processeur Quad Core (1,6 Ghz) - RAM 2048 Mo - 16 Go - Wi-Fi - Bluetooth - Android 4.1 Jelly Bean - White",
                'accroche' => "La Galaxy Tab qu'il vous faut",
                'reference' => 'GX07889-B',
                'ean' => '1234567891234',
                'tva' => 19.6,
                'prixHT' => '15',
                'prixTTC' => '21',
                'cover' => "Le GALAXY Note 8.0 propose de nombreuses solutions innovantes, simples d’utilisation : une option multifenêtres offre la possibilité de diviser en plusieurs parties l'écran 8 pouces pour gérer plusieurs applications en même temps; la technologie S Pen améliorée offre de nouvelles fonctionnalités; l’application S Note permet de créer, d'éditer, de gérer et de partager différents modèles de prise de note; une résolution parfaite pour un confort de lecture des e-books. De nouvelles fonctionnalités sont également offertes dans le Galaxy Note 8.0 avec pour la première fois dans une tablette Samsung : « Flipboard » et « Awesome Note ».",
                'content' => "Tout en mobilité
                    Avec son écran 8 pouces, le Galaxy Note 8.0 adopte la taille idéale pour allier mobilité et confort de navigation. Il devient possible de lire, regarder des vidéos, surfer, communiquer et même créer, le tout en mobilité. Conçu pour stocker et gérer toutes les données personnelles et professionnelles de manière efficace, le Galaxy Note 8.0 est l'accessoire de poche parfait pour l'organisation de son quotidien ainsi avec « S Note » et « S Calendrier » l’utilisateur peut prendre des notes en réunion, créer des listes de tâches, ou même tenir un journal personnel. Le nouveau S Pen offre une prise de note facile, rapide et plus précise que jamais.
                    De nouveaux usages et de nouvelles applications
                    Le « Mode Lecture » transforme le GALAXY Note 8.0 en livre électronique avec un confort de lecture optimal. Il est également possible d’utiliser sa tablette comme télécommande universelle grâce à Smart Remote pour contrôler son téléviseur, lecteur DVD et Blu-ray.
                    Le GALAXY Note 8.0 offre aussi de nouvelles applications embarquées telles que Awesome Note qui permet de réunir toutes les notes et tâches au même endroit (mémo, journal, liste de tâches etc). L’application Flipboard, optimisée pour le Galaxy Note 8.0, permet instantanément de feuilleter page à page son actualité préférée ainsi que les articles et photos de ses amis postés sur les différents réseaux sociaux.",
                'category' => 7,
                'service' => 'Garantie offerte',
                'video' => 'http://www.youtube.com/watch?v=IWAD3oKx7Yo',
                'etat' => 1,
                'status' => 1,
                'quantity' => 15,
                'poid' => 1.5,
                'longueur' => 20,
                'largeur' => 12,
                'hauteur' => 2
            ));


        $errors = $I->grabTextFrom('.alert');
        $errors = $I->grabTextFrom('.alert-warning');
        $I->expect($errors);

    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateProcessSuccessMarques(WebGuy $I)
    {
        $I->wantTo('Create Marque');
        $I->amOnPage('/backend/marques/creer');
        $I->see('Ajouter une marque');
        $I->submitForm('form#createmarque',
            array(
                'title' => "LG Group",
                'resume' => "LG (Lucky-Goldstar) est un chaebol (conglomérat industriel sud-coréen), spécialisé dans l'électronique (dont la domotique), les téléphones portables, l'air climatisé (troisième entreprise mondiale), le petit électroménager et depuis 2008 les Business Solutions (solaire, sécurité)2.Cette entreprise a été créée par Koo Ja-kyong, qui a laissé sa place à son fils aîné Koo Bon-moo en 1995. Au total, la famille Koo détient des participations dans 17 filiales du groupe LG dont 45,25 % dans LG Chemical et 35,89 % dans LG Capital Services.",
                'description' => 'GX07889-B',
                'metaTitle' => "LG (Lucky-Goldstar) est un chaebol (conglomérat industriel sud-coréen), spécialisé dans électronique (dont la domotique), les téléphones portables, l'air climatisé (troisième entreprise mondiale), le petit électroménager et depuis 2008 les Business Solutions (solaire, sécurité)2.",
                'metaDescription' => 'Cette entreprise a été créée par Koo Ja-kyong, qui a laissé sa place à son fils aîné Koo Bon-moo en 1995. Au total, la famille Koo détient des participations dans 17 filiales du groupe LG dont 45,25 % dans LG Chemical et 35,89 % dans LG Capital Services.',
                'metaKeywords' => 'LG, écran, LCD, LED'
            ));


//        $errors = $I->grabTextFrom('.alert');
//        $errors = $I->grabTextFrom('.alert-warning');
//        $I->expect($errors);

    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onEditProcessSuccessMarques(WebGuy $I)
    {
        $I->wantTo('Editer Marque');
        $I->amOnPage('backend/marques/editer/5');
        $I->see('Editer');
        $I->submitForm('form#editmarque',
            array(
                'title' => "Samsung Group",
                'resume' => "En 2013, le fabricant est devenu, selon Booz & Company et le Boston Consulting Group la deuxième entreprise la plus innovante au monde derrière Volkswagen. Le fabricant coréen a gagné 4 positions par rapport à 2012 grâce à une progression de 15% de ses dépenses de Recherche et développement (10,4 milliards de dollars)6,7.",
                'description' => "Le Groupe Samsung est un des principaux chaebol, ces conglomérats coréens constitués de différentes sociétés que lient des relations financières complexes. Plusieurs sociétés importantes s'y rattachent, dont l'entreprise d'électronique Samsung Electronics, connue du grand public par les téléviseurs ou la téléphonie mobile, et l'assureur Samsung Life.",
                'metaTitle' => "",
                'metaDescription' => "",
                'metaKeywords' => "",
                'active' => true,
                'parent' => 5
            ));


//        $errors = $I->grabTextFrom('.alert');
        $errors = $I->grabTextFrom('.alert-danger');
        $I->expect($errors);

    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onEditProcessSuccessProducts(WebGuy $I)
    {
        $I->wantTo('Edit Product Page');
        $I->amOnPage('/backend/produits');
        $I->see('Vos produits');
        $I->click('Editer');
        $uri = $I->grabFromCurrentUrl();
        $I->expect($uri);
        $I->see('Titre');

        $I->submitForm('form#editproduct',
            array(
                'title' => "Samsung UE46F6400 TV LCD 46 (116 cm) LED",
                'accroche' => "Profitez d’une expérience de visionnage unique"
            ));

        $uri = $I->grabFromCurrentUrl();
        $I->expect($uri);

//        $I->see('Vos produits');

        $errors = $I->grabTextFrom('.alert-danger');
//        $errors = $I->grabTextFrom('.alert-danger');
        $I->expect($errors);


    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCommercials(WebGuy $I)
    {
        $I->wantTo('In Commercials Page');
        $I->amOnPage('/backend/commercials');
        $I->see('Vos actions commerciales');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCommercialCreate(WebGuy $I)
    {
        $I->wantTo('In Commercials Create Page');
        $I->amOnPage('/backend/commercials/ajouter');
        $I->see('Créer une action');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCategories(WebGuy $I)
    {
        $I->wantTo('In Categories Page');
        $I->amOnPage('/backend/categories');
        $I->see('Vos catégories');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCategoriesCreate(WebGuy $I)
    {
        $I->wantTo('In Categories Page');
        $I->amOnPage('/backend/categories/ajouter');
        $I->see('Créer une catégorie');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onFamilies(WebGuy $I)
    {
        $I->wantTo('In Families Page');
        $I->amOnPage('/backend/familles');
        $I->see('Vos familles');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onFamilyCreate(WebGuy $I)
    {
        $I->wantTo('Create a family');
        $I->amOnPage('/backend/familles/ajouter');
        $I->see('Créer une famille');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onPages(WebGuy $I)
    {
        $I->wantTo('On Pages');
        $I->amOnPage('/backend/pages');
        $I->see('Vos pages');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreatePages(WebGuy $I)
    {
        $I->wantTo('On Pages');
        $I->amOnPage('/backend/pages/ajouter');
        $I->see('Créer une page');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onArticles(WebGuy $I)
    {
        $I->wantTo('On Articles');
        $I->amOnPage('/backend/articles');
        $I->see('Vos articles');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateArticles(WebGuy $I)
    {
        $I->wantTo('On Create Articles');
        $I->amOnPage('/backend/articles/ajouter');
        $I->see('Créer un article');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onTags(WebGuy $I)
    {
        $I->wantTo('On Tags');
        $I->amOnPage('/backend/tags');
        $I->see('Vos tags');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateTags(WebGuy $I)
    {
        $I->wantTo('Create Tag');
        $I->amOnPage('/backend/tags/ajouter');
        $I->see('Créer un tag');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onMedias(WebGuy $I)
    {
        $I->wantTo('Medias');
        $I->amOnPage('/backend/medias');
        $I->see('Vos images');
    }


}