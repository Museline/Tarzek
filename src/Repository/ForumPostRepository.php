<?php

namespace App\Repository;


use App\Entity\ForumPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * Description of ForumPostRepository
 * Repository pour les post du forum
 * @author Khael
 */

class ForumPostRepository extends ServiceEntityRepository{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumPost::class);
    }

}
