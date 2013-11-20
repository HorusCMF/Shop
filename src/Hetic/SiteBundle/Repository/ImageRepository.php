<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Hetic\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository
{

    public function getActiveImageQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Hetic\SiteBundle\Entity\Image', 'm')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }

}