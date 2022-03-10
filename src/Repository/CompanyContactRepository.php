<?php

namespace App\Repository;

use App\Entity\CompanyContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyContact[]    findAll()
 * @method CompanyContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyContact::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CompanyContact $entity, bool $flush = true): void
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
    public function remove(CompanyContact $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function search($name)
    {
        return $this->createQueryBuilder('companyContact')
            ->andWhere('companyContact.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->execute();
    }
    public function findCompanyContact()
    {
        $qb = $this->createQueryBuilder('p');
        //$qb->where('p.status=1');
        return $qb->getQuery(); // WITHOUT ->getResult(); !!
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
    //  * @return CompanyContact[] Returns an array of CompanyContact objects
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
    public function findOneBySomeField($value): ?CompanyContact
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
