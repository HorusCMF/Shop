<?php

namespace Horus\SiteBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'horus_site_hello'));
        $menu->addChild('Dashboard', array('route' => 'horus_site_dashboard' ));
        $menu->addChild('Contact', array('route' => 'horus_contact' ));
        $menu->addChild('Rechercher', array('route' => 'horus_search' ));

        return $menu;
    }
}