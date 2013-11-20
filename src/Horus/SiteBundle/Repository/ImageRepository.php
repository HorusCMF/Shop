<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository
{

    public function getActiveImageQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Image', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}