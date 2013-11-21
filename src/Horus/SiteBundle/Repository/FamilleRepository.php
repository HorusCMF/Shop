<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class FamilleRepository
 * @package Horus\SiteBundle\Repository
 */
class FamilleRepository extends EntityRepository
{

    /**
     * Get Active Familles
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveFamilleQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Famille', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}