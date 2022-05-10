<?php

namespace App\Repository;

use App\Entity\Jeu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Jeu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jeu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jeu[]    findAll()
 * @method Jeu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JeuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, jeu::class);
    }

    // /**
    //  * @return Prdouit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findPs4 ()
    {

        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery("SELECT j FROM APP\Entity\Jeu j WHERE j.categorie ='ps4'");
        return $query->getResult();

    }
    public function findPc ()
    {

        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery("SELECT j FROM APP\Entity\Jeu j WHERE j.categorie ='pc'");
        return $query->getResult();

    }
    public function findXbox ()
    {

        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery("SELECT j FROM APP\Entity\Jeu j WHERE j.categorie ='xbox'");
        return $query->getResult();

    }

    public function findByNom($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.nom LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    public function SortByNom()
    {
        return $this->createQueryBuilder('j')
            ->orderBy('j.nom', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function find_Nb_Rec_Par_Status($type)
    {

        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT DISTINCT  count(r.idJeu) FROM   App\Entity\jeu r  where r.categorie = :categorie   '
        );
        $query->setParameter('categorie', $type);
        return $query->getResult();
    }
}
