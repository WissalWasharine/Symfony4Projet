<?php

namespace App\Repository;


use App\Entity\PriceSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PriceSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceSearch[]    findAll()
 * @method PriceSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marque::class);
    }

    // /**
    //  * @return PriceSearch[] Returns an array of PriceSearch objects
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
    public function findOneBySomeField($value): ?PriceSearch
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
