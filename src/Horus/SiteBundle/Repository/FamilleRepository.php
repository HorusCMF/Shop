<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FamilleRepository extends EntityRepository
{

    public function getActiveFamilleQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Famille', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}