<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Hetic\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{

    public function getActivePageQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Hetic\SiteBundle\Entity\Page', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }


    public function isArticle()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HeticSiteBundle:Article a");
        return $query->getOneOrNullResult();
    }

}