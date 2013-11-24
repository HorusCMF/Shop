<?php
namespace Horus\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class AdministrateurRepository
 * @package Horus\SiteBundle\Repository
 */
class AdministrateurRepository extends EntityRepository
{
    /**
     * Get All Administrtors
     * @return \Doctrine\ORM\QueryBuilder
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


    /**
     * Find a User
     * @param null $uid
     * @return mixed
     */
    public function findUser($uid = null)
    {
        $q = $this->getEntityManager()->createQuery('
                SELECT u
                FROM HorusSiteBundle:Users u
                WHERE u.id = :uid');

        $q->setParameter('uid', $uid)
            ->setFirstResult(0)
            ->setMaxResults(1);
        return $q->getOneOrNullResult();
    }

    /**
     * Load a User by Username
     * @param $username
     * @return mixed
     * @throws UsernameNotFoundException
     */
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

    /**
     * Refresh a User to login
     * @param UserInterface $user
     * @return mixed
     * @throws UnsupportedUserException
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getId());
    }


    /**
     * Get Support Class
     * @param $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }

    /**
     * Existing an User
     * @param null $email
     * @return mixed
     */
    public function existUser($email = null)
    {
        $this->result = $this->createQueryBuilder('v')
            ->select('COUNT(v.id) as nb')
            ->where('v.email = :email')
            ->setParameter('email', $email);

        return $this->result->getQuery()->getOneOrNullResult();
    }


}