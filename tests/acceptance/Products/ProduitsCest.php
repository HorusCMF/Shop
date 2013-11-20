<?php
use \WebGuy;

class ProduitsCest
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
        $I->wantTo('perform actions and see result');
        $I->amOnPage('/');
        $I->see('Authentification');
        $I->see('Souvenir de moi');
        $I->amOnPage('/backend');
        $I->see('Authentification');
        $I->see('Souvenir de moi');

    }

    /**
     * On Home
     * @param WebGuy $I
     */
    public function onFailureAuthentificate(WebGuy $I) {
        $I->wantTo('perform actions and see result');
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
     * On Home
     * @param WebGuy $I
     */
    public function onSuccessAuthentificate(WebGuy $I) {
        $I->wantTo('perform actions and see result');
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



}