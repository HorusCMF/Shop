<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class PageRepository
 * @package Horus\SiteBundle\Repository
 */
class PageRepository extends EntityRepository
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
            ->from('Horus\SiteBundle\Entity\Page', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }


    /**
     * Is Article
     * @return mixed
     */
    public function isArticle()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Article a");
        return $query->getOneOrNullResult();
    }

}