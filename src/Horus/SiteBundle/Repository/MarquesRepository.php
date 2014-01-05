<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class MarquesRepository
 * @package Horus\SiteBundle\Repository
 */
class MarquesRepository extends EntityRepository
{


    /**
     * Get Active Page
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActivePageQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Marques', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }
}