<?php

namespace App\Repository;

use App\Entity\UserHasDiscovered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserHasDiscovered>
 *
 * @method UserHasDiscovered|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasDiscovered|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasDiscovered[]    findAll()
 * @method UserHasDiscovered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasDiscoveredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserHasDiscovered::class);
    }

    public function save(UserHasDiscovered $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserHasDiscovered $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findMatch(string $user,string $plante){
        $response=$this->findBy(["user"=>$user,"plant"=>$plante]);
        //dd($response);
        return $response;
    }


//    /**
//     * @return UserHasDiscovered[] Returns an array of UserHasDiscovered objects
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

//    public function findOneBySomeField($value): ?UserHasDiscovered
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
