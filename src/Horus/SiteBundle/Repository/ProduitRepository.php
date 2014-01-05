<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ProduitRepository
 * @package Horus\SiteBundle\Repository
 */
class ProduitRepository extends EntityRepository
{

    /**
     * Get Active Produit
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveProduitQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Produit', 'm')
//            ->where('m.dateCreated >= :dat')
            ->orderBy('m.id', 'DESC');
//            ->setParameter('dat', new \Datetime('2013-11-18'));
        return $queryBuilder;
    }
    /**
     * Get Active Produit
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getProduitDesciption()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Produit', 'm')
//            ->where('m.dateCreated >= :dat')
            ->orderBy('m.id', 'DESC');
//            ->setParameter('dat', new \Datetime('2013-11-18'));
        return $queryBuilder;
    }

    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getProductsIsQuantityNull()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Produit a WHERE a.quantity <= :quantity")
            ->setParameter('quantity', 3);
        return $query->getSingleScalarResult();
    }


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getProductsIsImagesNull()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Produit a  WHERE a.images IS EMPTY");
        return $query->getSingleScalarResult();
    }


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getProductsIsFournisseursNull()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Produit a WHERE a.fournisseur IS NULL");
        return $query->getSingleScalarResult();
    }

    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getProductsIsDesactive()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Produit a WHERE a.isVisible = :visible")
            ->setParameter('visible', false);
        return $query->getSingleScalarResult();
    }


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getProductsSoonBegin()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Produit a WHERE DATE_DIFF(a.datePublication,:dateend) <= 3 AND DATE_DIFF(a.datePublication,:dateend) >= 0  AND a.isVisible = :visible")
            ->setParameter('dateend', new \Datetime('now'))
            ->setParameter('visible', true);

        return $query->getSingleScalarResult();
    }

}