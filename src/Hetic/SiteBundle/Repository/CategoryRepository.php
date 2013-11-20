<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Hetic\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Hetic\SiteBundle\Entity\Category;

class CategoryRepository extends EntityRepository
{
    public function getArticlesByCategory(Category $category = null)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT a FROM HeticSiteBundle:Article a WHERE a.category = :category")
            ->setParameter('category', $category)
            ->setMaxResults(15);


        return $query->getResult();
    }

    public function getActiveCategoryQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Hetic\SiteBundle\Entity\Category', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

    public function isCategory()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HeticSiteBundle:Category a");
        return $query->getOneOrNullResult();
    }



}