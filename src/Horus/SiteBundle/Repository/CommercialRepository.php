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



    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCommercialIsDesactive()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Commercial a WHERE a.isVisible = :visible")
            ->setParameter('visible', false);
        return $query->getSingleScalarResult();
    }



    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCommercialSoonBegin()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Commercial a WHERE DATE_DIFF(a.datePublication,:dateend) <= 3 AND DATE_DIFF(a.datePublication,:dateend) >= 0  AND a.isVisible = :visible")
            ->setParameter('dateend', new \Datetime('now'))
            ->setParameter('visible', true);

        return $query->getSingleScalarResult();
    }


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCommercialSoonEnd()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Commercial a WHERE DATE_DIFF(a.dateFinPublication,:dateend) <= 3 AND DATE_DIFF(a.dateFinPublication,:dateend) >= 0  AND a.isVisible = :visible")
            ->setParameter('dateend', new \Datetime('now'))
            ->setParameter('visible', true);

        return $query->getSingleScalarResult();
    }


}