<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{

    public function getActivePageQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Page', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }


    public function isArticle()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Article a");
        return $query->getOneOrNullResult();
    }

}