<?php
use \WebGuy;

class CestModifyArticleCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

    public function goHome(WebGuy $I) {
        $I->wantTo('Je suis sur la home');
        $I->amOnPage('/');
    }

    public function authentification(WebGuy $I) {
        $I->wantTo('Je suis entrain detre authentifier');
        $I->amOnPage('/');
    }


}