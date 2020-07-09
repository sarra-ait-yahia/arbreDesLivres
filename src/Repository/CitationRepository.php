<?php

namespace App\Repository;

use App\Entity\Citation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Citation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Citation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Citation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Citation::class);
    }

    public function findAll()
    {
        return $this->findBy(array(), array('dateEcriture' => 'DESC'));
    }

    public function findByLivre($livre)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idLivre = :val')
            ->setParameter('val', $livre)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Citation[] Returns an array of Citation objects
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
    public function findOneBySomeField($value): ?Citation
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
