<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Hetic\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommercialRepository extends EntityRepository
{


    public function getActiveCommercialQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Hetic\SiteBundle\Entity\Commercial', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}