<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ClientRepository
 * @package Horus\SiteBundle\Repository
 */
class ClientRepository extends EntityRepository
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
            ->from('Horus\SiteBundle\Entity\Client', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }
}