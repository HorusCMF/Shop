<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommercialRepository extends EntityRepository
{


    public function getActiveCommercialQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Commercial', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}