<?php

namespace App\Repository;

use App\Entity\Shard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Shard>
 *
 * @method Shard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shard[]    findAll()
 * @method Shard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shard::class);
    }

//    /**
//     * @return Shard[] Returns an array of Shard objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Shard
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
