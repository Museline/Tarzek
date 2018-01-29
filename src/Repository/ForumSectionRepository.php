<?php

namespace App\Repository;

use App\Entity\ForumSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



/**
 * Description of ForumRepository
 * Repository pour les section du forum
 * @author Khael
 */
class ForumRepository extends ServiceEntityRepository{
    
    function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumSection::class);
    }
    

}
