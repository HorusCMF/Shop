<?php
// src/Acme/StoreBundle/Entity/ProductRepository.php
namespace Hetic\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AdministrateurRepository extends EntityRepository
{
    /**
     * @return QueryBuilder
     */
    public function createIsActiveQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('Hetic\SiteBundle\Entity\Article', 'm')
            ->leftJoin('m.category', 'c')
            ->leftJoin('m.tags', 't')
            ->orderBy('m.id', 'DESC');
        return $queryBuilder;
    }


    public function findUser($uid = null)
    {
        $q = $this->getEntityManager()->createQuery('
                SELECT u
                FROM HeticSiteBundle:Users u
                WHERE u.id = :uid');

        $q->setParameter('uid', $uid)
            ->setFirstResult(0)
            ->setMaxResults(1);
        return $q->getOneOrNullResult();
    }

    public function loadUserByUsername($username)
    {
        /**
         * Load Users
         */
        $q = $this
            ->createQueryBuilder('u')
            ->where('u.email = :email')
            ->andWhere('u.enabled = :actif')
            ->setParameter('email', $username)
            ->setParameter('actif', true)
            ->getQuery();

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(sprintf('Unable to find an active admin SiteBundle:Users object identified by "%s".', $username), null, 0, $e);
        }

        return $user;
    }


    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }


    public function supportsClass($class)
    {
        return $class === "Hetic\SiteBundle\Entity\Administrateur";
    }

    public function existUser($email = null)
    {
        $this->result = $this->createQueryBuilder('v')
            ->select('COUNT(v.id) as nb')
            ->where('v.email = :email')
            ->setParameter('email', $email);

        return $this->result->getQuery()->getOneOrNullResult();
    }




    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
        ->createQuery('SELECT p FROM HeticSiteBundle:Article p  ORDER BY p.title ASC')->getResult();
    }

    public function getArticlesByDate()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HeticSiteBundle:Article p WHERE p.category = 1 ORDER BY p.datePublication ASC')->getResult();
    }

    public function getArticlesByRate()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HeticSiteBundle:Article p ORDER BY p.point DESC')->getResult();
    }

    public function getArticlesByCategory($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HeticSiteBundle:Article p WHERE p.category = :category ORDER BY p.point DESC')
            ->setParameter('category', $id)
            ->getResult();
    }

    public function getArticlesByTags($tag)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HeticSiteBundle:Article p JOIN p.tags t WHERE t.word = :tag')
            ->setParameter('tag', $tag)
            ->getResult();
    }

    public function findVisibleArticles()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HeticSiteBundle:Article p WHERE p.isVisible = :visible ORDER BY p.title ASC')
            ->setParameter('visible', '1')
            ->getResult();
    }

    public function findVisibleNowArticles()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM HeticSiteBundle:Article p WHERE p.datePublication >= :datePublication AND p.isVisible = :visible')
            ->setParameter('datePublication', new \Datetime('now'))
            ->setParameter('visible', '1')
            ->getResult();
    }
}