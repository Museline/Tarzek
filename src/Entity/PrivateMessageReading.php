<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrivateMessageReadingRepository")
 */
class PrivateMessageReading
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var PrivateMessage $message message a traiter
     * @ORM\ManyToOne(targetEntity="App\Entity\PrivateMessage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $message;

    /**
     * @var User $recipient destinataire du message privé
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipient;

    /**
     * @var bool $reading lecture du message privé par le destinataire
     * @ORM\Column(type="boolean")
     * @Assert\Type("bool")
     */
    private $reading;

    public function __construct()
    {
        $this->reading = false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isReading(): bool
    {
        return $this->reading;
    }

    /**
     * @param bool $reading
     */
    public function setReading(bool $reading): void
    {
        $this->reading = $reading;
    }

    /**
     * @return PrivateMessage
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param PrivateMessage $message
     */
    public function setMessage(PrivateMessage $message): void
    {
        $this->message = $message;
    }

    /**
     * @return User
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param User $recipient
     */
    public function setRecipient(User $recipient): void
    {
        $this->recipient = $recipient;
    }
}
