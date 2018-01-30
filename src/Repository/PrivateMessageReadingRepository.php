<?php

namespace App\Repository;

use App\Entity\PrivateMessageReading;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PrivateMessageReadingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PrivateMessageReading::class);
    }

    public function findByUserAndMessage($user, $message)
    {
        return $this->createQueryBuilder('pmr')
            ->andWhere('pmr.recipient = :user')
            ->andWhere('pmr.message = :message')
            ->setParameter('user', $user)
            ->setParameter('message', $message)
            ->getQuery()
            ->getResult()
        ;
    }
}
