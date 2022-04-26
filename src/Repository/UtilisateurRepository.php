<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /*
        /**
         * @throws ORMException
         * @throws OptimisticLockException
         */
    public function add(User $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(User $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return User[] Returns an array of User objects
     */

    public function DisplayUsers()
    {
        return $this->createQueryBuilder('u')
            ->Where('u.isdeleted = 0')
            ->getQuery()
            ->getResult();
    }

    public function orderByMail()
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.email', 'ASC')
            ->setMaxResults(30);
        return $qb->getQuery()
            ->getResult();
    }

    public function orderById()
    {
        $qb = $this->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(30);
        return $qb->getQuery()
            ->getResult();
    }


    public function searchUser($name)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.username LIKE :x')
            ->setParameter('x', '%' . $name . '%')
            ->getQuery()
            ->execute();
    }

/*
    public function findCoachs()
    {
        $entityManager = $this->getEntityManager();
        $e ="ROLE_COACH";
        $query = $entityManager
            ->createQuery("SELECT s FROM APP\Entity\User s
             WHERE s.roles ="."ROLE_COACH");
        return $query->getResult();
    }
*/
    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
