<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Description of UserRepository
 *
 * @author Khael
 */
class UserRepository extends ServiceEntityRepository {
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findUsersSearch($username)
    {
        $qb = $this->createQueryBuilder('u');

        $qb ->where($qb->expr()->like('u.username', $qb->expr()->literal('%'.$username.'%')))
            ->getQuery();

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
