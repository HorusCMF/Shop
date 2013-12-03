<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ImageRepository
 * @package Horus\SiteBundle\Repository
 */
class ImageMarquesRepository extends EntityRepository
{


    /**
     * If on category
     * @return mixed
     */
    public function isFirstImage($id = null)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:ImageMarques a WHERE a.marque = :marque")->setParameter('marque', $id);
        return $query->getOneOrNullResult();
    }

}