<?php

namespace Hetic\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\CssSelector\CssSelector;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($crawler->filter("html:contains('popularité')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Category')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Pékin Express')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('sex-appeal')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('suppressions de postes')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Titre')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Contenu')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Tags')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Actions')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Sauvegarder')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Actua Bd')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Lilian Thuram')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('footballeur')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Une fillette')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Quels parents')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('Hervé')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('les bienvenus')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('les bienvenus')")->count() > 0);
//        $this->assertTrue($crawler->filter("html:contains('les bienvenus')")->count() > 0);
//        $this->assertEquals(1,$crawler->filter("html:contains('les fsyuyusdgfyusd')")->count());
//        $this->assertNotEmpty($crawler->filter("html:contains('les bienvenus')"));
//        $this->assertContains(4, array(1, 2, 3));
        $this->assertContains(4, array(1, 2, 3, 4));
//        $this->assertContains("article"$errors, $crawler->filter('body > h3')->eq(0));

        $form = $crawler->selectButton('Sauvegarder')->form();

// définit certaines valeurs
        $form['title'] = 'Hello World!';
        $form['category'] = 3;
        $form['tags'] = array(5,2);
        $form['content'] = 'Coucou!';
//
//        $form = $crawler->selectButton('validate')->form();
//
//// soumet le formulaire
        $client->submit($form);
//
//        $errors = $crawler->filter('.alert')->eq(0)->text();
////        print_r(print CssSelector::toXPath('div.alert'));
//        print_r($errors);


//        $link = $crawler->filter('a:contains("La Fillette Improvise Sur Le Spectacle De Danse De Son ecole")')->eq(1)->link();


    }
}
