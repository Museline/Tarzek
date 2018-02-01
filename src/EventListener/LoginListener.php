<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;

/**
 * Description of ConnectionListener
 *
 * @author Khael
 */
class LoginListener {
    
    /**
     *
     * @var object $em EntityManager object
     */
    private $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function lastLogin(InteractiveLoginEvent $event){
        
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLoginDate(new \DateTime());
        $this->em->flush($user);
        
    }
}
