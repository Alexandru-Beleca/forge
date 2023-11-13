<?php

namespace App\Repository;

use App\Entity\PnjData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PnjData>
 *
 * @method PnjData|null find($id, $lockMode = null, $lockVersion = null)
 * @method PnjData|null findOneBy(array $criteria, array $orderBy = null)
 * @method PnjData[]    findAll()
 * @method PnjData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PnjDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PnjData::class);
    }

//    /**
//     * @return PnjData[] Returns an array of PnjData objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PnjData
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
