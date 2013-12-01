<?php

namespace Horus\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\CssSelector\CssSelector;

/**
 * Class DefaultControllerTest
 * @package Horus\SiteBundle\Tests\Controller
 */
class MainControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
    }
}
