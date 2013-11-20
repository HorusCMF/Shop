<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace Hetic\SiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'hetic_site_hello'));
        $menu->addChild('Dashboard', array('route' => 'hetic_site_dashboard' ));
        $menu->addChild('Contact', array('route' => 'hetic_contact' ));
        $menu->addChild('Rechercher', array('route' => 'hetic_search' ));

        return $menu;
    }
}