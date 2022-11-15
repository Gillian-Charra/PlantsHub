<?php

namespace App\Repository;

use App\Entity\UserHasDicovered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserHasDicovered>
 *
 * @method UserHasDicovered|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasDicovered|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasDicovered[]    findAll()
 * @method UserHasDicovered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasDicoveredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserHasDicovered::class);
    }

    public function save(UserHasDicovered $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserHasDicovered $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UserHasDicovered[] Returns an array of UserHasDicovered objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserHasDicovered
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
