<?php

namespace App\Repository;

use App\Entity\AdSearch;
use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    // /**
    //  * @return Advert[] Returns an array of Advert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advert
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findDepartment($department)
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.department = :d')
            ->setParameter('d', $department)
            ->getQuery()
            ->getResult();

        return $query;

    }

    /**
     * @param string|null $term
     */
    public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('a');

        return $qb
            ->orderBy('a.date', 'DESC')
            ;
    }

    /**
     * @param string|null $term
     */
    public function getByDepartmentQueryBuilder(?string $department): QueryBuilder
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.department LIKE :department')
            ->setParameter('department', $department)
            ->getQuery()
            ->getResult();

        return $qb;
    }

}
