<?php
namespace App\Entity;

use \Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
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
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\Column (type="string", length=30)
     */
    private $l_name;
    
    /**
     * @ORM\Column (type="string", length=30)
     */
    private $f_name;
    
    /**
     * @ORM\Column (type="string", length=100)
     */
    private $adress;
    
    /**
     * @ORM\Column (type="string", length=30)
     */
    private $city;
    
    /**
     * @ORM\Column (type="string", length=30)
     */
    private $post_code;
    
    /**
     * @ORM\Column (type="string", length=30)
     */
    private $phone_numb;
    
    /**
     * @ORM\Column (type="array")
     */
    private $roles;
    
    /**
     * @ORM\Column (type="string", length=255, nullable=true)
     */
    private $avatar_URL;
    
    /**
    * @ORM\OneToOne(targetEntity="App\Entity\UserAvatar", cascade={"persist", "remove"})
    * 
    */
     private $avatar_upload;
    
    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        $this->roles = ["ROLE_USER"];
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
}
