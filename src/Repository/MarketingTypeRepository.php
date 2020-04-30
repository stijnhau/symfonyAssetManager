<?php

namespace App\Repository;

use App\Entity\MarketingType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarketingType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketingType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketingType[]    findAll()
 * @method MarketingType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketingTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketingType::class);
    }

    // /**
    //  * @return MarketingType[] Returns an array of MarketingType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarketingType
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
