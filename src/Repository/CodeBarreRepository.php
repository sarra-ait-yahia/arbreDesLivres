<?php

namespace App\Repository;

use App\Entity\CodeBarre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodeBarre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeBarre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeBarre[]    findAll()
 * @method CodeBarre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeBarreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeBarre::class);
    }

    public function search($code) {
        return $this->createQueryBuilder('c')
            ->andWhere('c.code LIKE :codeB')
            ->setParameter('codeB', $code)
            ->getQuery()
            ->execute();
    }

    // /**
    //  * @return CodeBarre[] Returns an array of CodeBarre objects
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
    public function findOneBySomeField($value): ?CodeBarre
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
