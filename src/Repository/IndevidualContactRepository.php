<?php

namespace App\Repository;

use App\Entity\IndevidualContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IndevidualContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndevidualContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndevidualContact[]    findAll()
 * @method IndevidualContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndevidualContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndevidualContact::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(IndevidualContact $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(IndevidualContact $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    function findByUser($user)
    {
        $query = $this->createQueryBuilder('a')
            ->select('a')
            ->leftJoin('a.user', 'c')
            ->addSelect('c');

        $query = $query->add('where', $query->expr()->in('c', ':c'))
            ->setParameter('c', $user)
            ->getQuery()
            ->getResult();

        return $query;
    }

    // /**
    //  * @return IndevidualContact[] Returns an array of IndevidualContact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IndevidualContact
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
