<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * Description of User
 * Object User for registration
 * @author Khael
 */

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 25,
     *      minMessage = "Le Pseudo doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le Pseudo doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Regex(
     *      pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{1,}$/",
     *      message="Le Mot de Passe doit contenir au moins une majuscule et un chiffre"
     * )
     * @Assert\Length(
     *      min=5,
     *      minMessage = "Le mot de passe doit contenir au moins {{ limit }} caractères",
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\Column (type="string", length=30)
     * @Assert\Length(
     *      min=3, 
     *      max=30,
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom doit contenir au moins {{ limit }} caractères"
     * )
     */
    private $l_name;
    
    /**
     * @ORM\Column (type="string", length=30)
     * @Assert\Length(
     *      min=3, 
     *      max=30,
     *      minMessage = "Le prénom doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le prénom doit contenir au moins {{ limit }} caractères"
     * )
     */
    private $f_name;
    
    /**
     * @ORM\Column (type="string", length=100)
     * @Assert\Length(
     *      min=3, 
     *      max=100,
     *      minMessage = "L'adresse doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "L'adresse doit contenir au moins {{ limit }} caractères"
     * )
     */
    private $adress;
    
    /**
     * @ORM\Column (type="string", length=30)
     * @Assert\Length(
     *      min=3, 
     *      max=30,
     *      minMessage = "Le nom de la ville doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le nom de la ville doit contenir au moins {{ limit }} caractères"
     * )
     */
    private $city;
    
    /**
     * @ORM\Column (type="string", length=30)
     * 
     */
    private $post_code;
    
    /**
     * @ORM\Column (type="string", length=30)
     * @Assert\Regex(
     *      pattern="/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/",
     *      message = "Le numéro de téléphone doit être du type +33X-XX-XX-XX-XX ou 0X.XX.XX.XX.XX"
     * )
     */
    private $phone_numb;
    
    /**
     * @ORM\Column (type="array")
     */
    private $roles;
    
    /**
     * @ORM\Column (type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $avatar_URL;
    
    /**
    * @ORM\OneToOne(targetEntity="App\Entity\UserAvatar", cascade={"persist", "remove"})
    * 
    */
     private $avatar_upload;

    /**
     * @var array $messages messages privés reçus
     * @ORM\ManyToMany(targetEntity="App\Entity\PrivateMessage", mappedBy="recipients", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
     private $messages;
     
     /**
      * @ORM\Column(type="datetime")
      * @var \DateTime
      * @Assert\DateTime()
      */
     private $registration_date;
     
     /**    
      * @ORM\Column(type="datetime", nullable=true)
      * @var \DateTime
      * @Assert\DateTime()
      */
     private $last_login_date;
    
    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        $this->roles = ["ROLE_USER"];
        $this->messages = new ArrayCollection();
        $this->registration_date = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getLName()
    {
        return $this->l_name;
    }

    public function getFName()
    {
        return $this->f_name;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPostCode()
    {
        return $this->post_code;
    }

    public function getPhoneNumb()
    {
        return $this->phone_numb;
    }

    public function getAvatarURL()
    {
        return $this->avatar_URL;
    }
    
    public function getAvatarUpload(){
        return $this->avatar_upload;
    }

    public function setUsername($username){
        $this->username = $username;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }
    
    public function setLName($l_name)
    {
        $this->l_name = $l_name;
    }

    public function setFName($f_name)
    {
        $this->f_name = $f_name;
    }

    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setPostCode($post_code)
    {
        $this->post_code = $post_code;
    }

    public function setPhoneNumb($phone_numb)
    {
        $this->phone_numb = $phone_numb;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    public function setAvatarURL($avatar_URL)
    {
        $this->avatar_URL = $avatar_URL;
    }

    public function setAvatarUpload(UserAvatar $avatar_upload){
        $this->avatar_upload = $avatar_upload;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Méthode pour ajouter un message privé reçu
     * @param PrivateMessage $message
     */
    public function addMessage(PrivateMessage $message)
    {
        if ($this->messages->contains($message)) {
            return;
        }

        $this->messages[] = $message;
    }

    /**
     * Méthode pour supprimer un message de la liste
     * @param User $recipient
     */
    public function removeMessage(PrivateMessage $message)
    {
        $this->messages->removeElement($message);

        $message->addRecipient(null);
    }
    
    public function getRegistrationDate(): \DateTime
    {
        return $this->registration_date;
    }

    public function getLastLoginDate(): \DateTime
    {
        return $this->last_login_date;
    }

    public function setRegistrationDate(\DateTime $registration_date)
    {
        $this->registration_date = $registration_date;
    }

    public function setLastLoginDate(\DateTime $last_login_date)
    {
        $this->last_login_date = $last_login_date;
    }


}
