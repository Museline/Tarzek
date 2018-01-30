<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrivateMessageRepository")
 */
class PrivateMessage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var object $sender expéditeur du message privé
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    /**
     * @var array $receiver destinataires du message privé
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="messages")
     */
    private $recipients;

    /**
     * @var string $title titre du message privé
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Le titre du message doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le titre du message doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @var string $message contenu du message privé
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Le contenu du message doit contenir au minimum {{ limit }} caractères"
     * )
     */
    private $message;

    /**
     * @var \DateTime $sending_date date d'envoir du message privé
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $sending_date;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
        $this->sending_date = new \Datetime();
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
     * @return User
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param User $sender
     */
    public function setSender(User $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return Collection|User[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Méthode pour ajouter un destinataire un à message
     * @param User $recipient
     */
    public function addRecipient(User $recipient)
    {
        if ($this->recipients->contains($recipient)) {
            return;
        }

        $this->recipients[] = $recipient;

        $recipient->addMessage($this);
    }

    /**
     * Méthode pour supprimer un destinataire d'un message
     * @param User $recipient
     */
    public function removeRecipient(User $recipient)
    {
        $this->recipients->removeElement($recipient);
        // set the owning side to null
        // $recipient->setMessage(null);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return \DateTime
     */
    public function getSendingDate(): \DateTime
    {
        return $this->sending_date;
    }

    /**
     * @param \DateTime $sending_date
     */
    public function setSendingDate(\DateTime $sending_date): void
    {
        $this->sending_date = $sending_date;
    }
}
