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

}