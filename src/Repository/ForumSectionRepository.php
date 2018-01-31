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
class ForumSectionRepository extends ServiceEntityRepository{
    
    function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumSection::class);
    }
    
    public function findPost($id){
 
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder
                ->select('all')
                ->from('forum_section')
                ->where('url_name = ?')
                ->setParameter(0, $url_name)
        ;
    }
}
