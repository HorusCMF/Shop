<?php

namespace Horus\SiteBundle\Configuration;
use Doctrine\ORM\EntityManager;


/**
 * Email Service
 */
class Configuration {



    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;


    /**
     * Configuration
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }


    /**
     * Get All Configuration
     * @return mixed
     */
    public function getAllConfigure(){
        return $this->em->getRepository('HorusSiteBundle:Configuration')->find(1);
    }

}

?>
