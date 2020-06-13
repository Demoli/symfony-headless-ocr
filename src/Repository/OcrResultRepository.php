<?php

namespace App\Repository;

use App\Entity\OcrResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OcrResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method OcrResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method OcrResult[]    findAll()
 * @method OcrResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OcrResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OcrResult::class);
    }

    // /**
    //  * @return OcrResult[] Returns an array of OcrResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OcrResult
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
