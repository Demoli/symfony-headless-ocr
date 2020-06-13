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

    /**
     * @param array $fileIds
     *
     * @return OcrResult[]
     */
    public function findByFileIds(array $fileIds)
    {
        $qb     = $this->createQueryBuilder('o');
        $result = $qb->orderBy('o.created', 'DESC')
            ->setMaxResults(5)
            ->add('where', $qb->expr()->in('o.fileId', $fileIds))
            ->getQuery()
            ->getResult();

        return $result;
    }

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
