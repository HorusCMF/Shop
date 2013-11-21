<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CommercialRepository
 * @package Horus\SiteBundle\Repository
 */
class CommercialRepository extends EntityRepository
{

    /**
     * Get Active Commercials
     * @return \Doctrine\ORM\QueryBuilder
     */
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