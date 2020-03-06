<?php

namespace App\Repository;

use App\Entity\BacklogSprint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BacklogSprint|null find($id, $lockMode = null, $lockVersion = null)
 * @method BacklogSprint|null findOneBy(array $criteria, array $orderBy = null)
 * @method BacklogSprint[]    findAll()
 * @method BacklogSprint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BacklogSprintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BacklogSprint::class);
    }

    // /**
    //  * @return BacklogSprint[] Returns an array of BacklogSprint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BacklogSprint
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
