<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CommentaireRepository
 * @package Horus\SiteBundle\Repository
 */
class CommentaireRepository extends EntityRepository
{


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCommentaireIsDesactive()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Commentaire a WHERE a.visible = :visible")
            ->setParameter('visible', 1);
        return $query->getSingleScalarResult();
    }


    /**
     * Get articles by Category
     * @param Category $category
     * @return mixed
     */
    public function getCommentaireWait()
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT COUNT(a.id) FROM HorusSiteBundle:Commentaire a WHERE a.visible = :visible")
            ->setParameter('visible', 2);
        return $query->getSingleScalarResult();
    }


}