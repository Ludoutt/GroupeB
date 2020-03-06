<?php

namespace App\Repository;

use App\Entity\BacklogProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BacklogProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method BacklogProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method BacklogProduct[]    findAll()
 * @method BacklogProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BacklogProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BacklogProduct::class);
    }

    // /**
    //  * @return BacklogProduct[] Returns an array of BacklogProduct objects
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
    public function findOneBySomeField($value): ?BacklogProduct
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
