<?php
namespace App\Entity;

use \Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Description of User
 * Object User for registration
 * @author Khael
 */

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable {
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
     * @ORM\Column (type="string", length=255)
     */
    private $avatar;
    
    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        $this->roles = ["ROLE_USER"];
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
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
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

    public function getAvatar()
    {
        return $this->avatar;
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

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


}
