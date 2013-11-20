<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

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


    public function isPage()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a) nombre FROM HorusSiteBundle:Page a");
        return $query->getOneOrNullResult();
    }


    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
        ->createQuery('SELECT p FROM HorusSiteBundle:Article p  ORDER BY p.title ASC')->getResult();
    }

    public function getArticlesByDate()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HorusSiteBundle:Article p WHERE p.category = 1 ORDER BY p.datePublication ASC')->getResult();
    }

    public function getArticlesByRate()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HorusSiteBundle:Article p ORDER BY p.point DESC')->getResult();
    }

    public function getArticlesByCategory($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HorusSiteBundle:Article p WHERE p.category = :category ORDER BY p.point DESC')
            ->setParameter('category', $id)
            ->getResult();
    }

    public function getArticlesByTags($tag)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HorusSiteBundle:Article p JOIN p.tags t WHERE t.word = :tag')
            ->setParameter('tag', $tag)
            ->getResult();
    }

    public function findVisibleArticles()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HorusSiteBundle:Article p WHERE p.isVisible = :visible ORDER BY p.title ASC')
            ->setParameter('visible', '1')
            ->getResult();
    }

    public function findVisibleNowArticles()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HorusSiteBundle:Article p WHERE p.datePublication >= :datePublication AND p.isVisible = :visible')
            ->setParameter('datePublication', new \Datetime('now'))
            ->setParameter('visible', '1')
            ->getResult();
    }
}