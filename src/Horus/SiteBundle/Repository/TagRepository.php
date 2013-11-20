<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function getTags()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Horus\SiteBundle\Entity\Tag', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}