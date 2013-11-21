<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ArticleRepository
 * @package Horus\SiteBundle\Repository
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @return QueryBuilder
     */
    public function createIsActiveQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Article', 'm')
            ->leftJoin('m.category', 'c')
            ->leftJoin('m.tags', 't')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

    /**
     * Is Page
     * @return mixed
     */
    public function isPage()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Page a");
        return $query->getOneOrNullResult();
    }

}