<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Hetic\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FamilleRepository extends EntityRepository
{

    public function getActiveFamilleQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Hetic\SiteBundle\Entity\Famille', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}