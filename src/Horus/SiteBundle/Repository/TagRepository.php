<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TagRepository
 * @package Horus\SiteBundle\Repository
 */
class TagRepository extends EntityRepository
{
    /**
     * Get Tags
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getTags()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Tag', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}