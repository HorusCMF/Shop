<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Horus\SiteBundle\Entity\Category;

class CategoryRepository extends EntityRepository
{
    public function getArticlesByCategory(Category $category = null)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT a FROM HorusSiteBundle:Article a WHERE a.category = :category")
            ->setParameter('category', $category)
            ->setMaxResults(15);


        return $query->getResult();
    }

    public function getActiveCategoryQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Category', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

    public function isCategory()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Category a");
        return $query->getOneOrNullResult();
    }



}