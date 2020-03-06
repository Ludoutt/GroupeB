<?php

namespace App\Repository;

use App\Entity\UserStories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserStories|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStories|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStories[]    findAll()
 * @method UserStories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserStories::class);
    }

    // /**
    //  * @return UserStories[] Returns an array of UserStories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserStories
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
