<?php

namespace App\Repository;

use App\Entity\Ninja;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ninja|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ninja|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ninja[]    findAll()
 * @method Ninja[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NinjaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ninja::class);
    }

    // /**
    //  * @return Ninja[] Returns an array of Ninja objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ninja
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function countNinja()
    {
        $qb = $this->createQueryBuilder('t');
        return $qb
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
