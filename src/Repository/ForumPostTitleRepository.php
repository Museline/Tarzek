<?php

namespace App\Repository;

use App\Entity\ForumPostTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * Description of ForumPostRepository
 * Repository pour les titre des post du forum
 * @author Khael
 */

class ForumPostTitleRepository extends ServiceEntityRepository{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumPostTitle::class);
    }

}