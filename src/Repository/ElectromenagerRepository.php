<?php

namespace App\Repository;

use App\Entity\Electromenager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Electromenager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electromenager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electromenager[]    findAll()
 * @method Electromenager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectromenagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electromenager::class);
    }
    public function findByPriceRange($minValue,$maxValue)
 {
 return $this->createQueryBuilder('a')
 ->andWhere('a.prix >= :minVal')
 ->setParameter('minVal', $minValue)
 ->andWhere('a.prix <= :maxVal')
 ->setParameter('maxVal', $maxValue)
 ->orderBy('a.id', 'ASC')
 ->setMaxResults(10)
 ->getQuery()
 ->getResult()
 ;



}

    // /**
    //  * @return Electromenager[] Returns an array of Electromenager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Electromenager
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
