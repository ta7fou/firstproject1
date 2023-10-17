<?php

namespace App\Repository;

use App\Entity\classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<classroom>
 *
 * @method classroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method classroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method classroom[]    findAll()
 * @method classroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class classroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, classroom::class);
    }

//    /**
//     * @return classroom[] Returns an array of classroom objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?classroom
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
