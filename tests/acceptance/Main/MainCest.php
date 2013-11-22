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
    public function onHome(WebGuy $I) {
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
    public function onFailureAuthentificate(WebGuy $I) {
        $I->wantTo('on Failure Auth');
        $I->amOnPage('/');
        $I->see('Authentification');
        $I->submitForm('form',
            array(
                '_username' => 'test@yahoo.fr',
                '_password' => 'ok',
            ));
        $errors = $I->grabTextFrom('.alert');
        $I->expect($errors);
    }

    /**
     * On Success Auth
     * @param WebGuy $I
     */
    public function onSuccessAuthentificate(WebGuy $I) {
        $I->wantTo('on Success Authentificate');
        $I->amOnPage('/');
        $I->see('Authentification');
        $I->submitForm('form',
            array(
                '_username' => 'test@yahoo.fr',
                '_password' => 'djscrave',
            ));
        $I->amOnPage('/backend');
        $I->see('Modern Solution for E-Commerce for Minimalist Operations');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onProducts(WebGuy $I) {
        $I->wantTo('In Products Page');
        $I->amOnPage('/backend/produits');
        $I->see('Vos produits');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateProducts(WebGuy $I) {
        $I->wantTo('In Products Create Page');
        $I->amOnPage('/backend/produits/creer');
        $I->see('Créer un produit');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateProcessFailureProducts(WebGuy $I) {
        $I->wantTo('In Products Create Page');
        $I->amOnPage('/backend/produits/creer');
        $I->see('Créer un produit');
        $I->submitForm('form#createproduct',
            array(
                'accroche' => 'o',
                'reference' => 'ok',
                'ean' => 'ok',
                'prixHT' => 'ok',
                'prixTTC' => 'ok',
            ));
        $errors = $I->grabTextFrom('.alert');
        $I->see('Le titre ne doit pas etre vide');
        $I->see('Le résumé ne doit pas etre vide');
        $I->see('La description ne doit pas etre vide');
        $I->see("Le prix HT n'est pas valide");
        $I->see("Le prix TTC n'est pas valide");
        $I->see('Votre accroche doit faire au moins 5 caractères');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCommercials(WebGuy $I) {
        $I->wantTo('In Commercials Page');
        $I->amOnPage('/backend/commercials');
        $I->see('Vos actions commerciales');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCommercialCreate(WebGuy $I) {
        $I->wantTo('In Commercials Create Page');
        $I->amOnPage('/backend/commercials/ajouter');
        $I->see('Créer une action');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCategories(WebGuy $I) {
        $I->wantTo('In Categories Page');
        $I->amOnPage('/backend/categories');
        $I->see('Vos catégories');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCategoriesCreate(WebGuy $I) {
        $I->wantTo('In Categories Page');
        $I->amOnPage('/backend/categories/ajouter');
        $I->see('Créer une catégorie');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onFamilies(WebGuy $I) {
        $I->wantTo('In Families Page');
        $I->amOnPage('/backend/familles');
        $I->see('Vos familles');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onFamilyCreate(WebGuy $I) {
        $I->wantTo('Create a family');
        $I->amOnPage('/backend/familles/ajouter');
        $I->see('Créer une famille');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onPages(WebGuy $I) {
        $I->wantTo('On Pages');
        $I->amOnPage('/backend/pages');
        $I->see('Vos pages');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreatePages(WebGuy $I) {
        $I->wantTo('On Pages');
        $I->amOnPage('/backend/pages/ajouter');
        $I->see('Créer une page');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onArticles(WebGuy $I) {
        $I->wantTo('On Articles');
        $I->amOnPage('/backend/articles');
        $I->see('Vos articles');
    }


    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateArticles(WebGuy $I) {
        $I->wantTo('On Create Articles');
        $I->amOnPage('/backend/articles/ajouter');
        $I->see('Créer un article');
    }



    /**
     * @before onSuccessAuthentificate
     */
    public function onTags(WebGuy $I) {
        $I->wantTo('On Tags');
        $I->amOnPage('/backend/tags');
        $I->see('Vos tags');
    }



    /**
     * @before onSuccessAuthentificate
     */
    public function onCreateTags(WebGuy $I) {
        $I->wantTo('Create Tag');
        $I->amOnPage('/backend/tags/ajouter');
        $I->see('Créer un tag');
    }



    /**
     * @before onSuccessAuthentificate
     */
    public function onMedias(WebGuy $I) {
        $I->wantTo('Medias');
        $I->amOnPage('/backend/medias');
        $I->see('Vos images');
    }



}