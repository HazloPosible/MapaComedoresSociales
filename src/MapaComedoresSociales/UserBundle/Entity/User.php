<?php

namespace MapaComedoresSociales\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * MapaComedoresSociales\UserBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User implements AdvancedUserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="MapaComedoresSociales\PantryBundle\Entity\Pantry", mappedBy="user")
     **/
    private $pantries;

    /**
     * @ORM\OneToMany(targetEntity="MapaComedoresSociales\CommentBundle\Entity\Comment", mappedBy="user")
     **/
    private $comments;

    /**
     * @var boolean $isEnable
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $isEnable;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime $create_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @var \DateTime $last_login_at
     *
     * @ORM\Column(name="last_login_at", type="datetime", nullable=true)
     */
    private $last_login_at;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pantries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();

        $this->active = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * Add pantries
     *
     * @param \MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries
     * @return User
     */
    public function addPantrie(\MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries)
    {
        $this->pantries[] = $pantries;
    
        return $this;
    }

    /**
     * Remove pantries
     *
     * @param \MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries
     */
    public function removePantrie(\MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries)
    {
        $this->pantries->removeElement($pantries);
    }

    /**
     * Add comments
     *
     * @param \MapaComedoresSociales\CommentBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\MapaComedoresSociales\CommentBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \MapaComedoresSociales\CommentBundle\Entity\Comment $comments
     */
    public function removeComment(\MapaComedoresSociales\CommentBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
    *
    *  User Interfaces set up
    */

    // UserInterface
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {

    } 

    // AdvancedUserInterface
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

    public function isEqualTo(UserInterface $user)
    {
        return $this->email === $user->getUsername();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list ($this->id,
        ) = unserialize($serialized);
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isEnable
     *
     * @param boolean $isEnable
     * @return User
     */
    public function setIsEnable($isEnable)
    {
        $this->isEnable = $isEnable;
    
        return $this;
    }

    /**
     * Get isEnable
     *
     * @return boolean 
     */
    public function getIsEnable()
    {
        return $this->isEnable;
    }

    /**
     * Set isAactive
     *
     * @param boolean $isAactive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isAactive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set last_login_at
     *
     * @param \DateTime $lastLoginAt
     * @return User
     */
    public function setLastLoginAt($lastLoginAt)
    {
        $this->last_login_at = $lastLoginAt;
    
        return $this;
    }

    /**
     * Get last_login_at
     *
     * @return \DateTime 
     */
    public function getLastLoginAt()
    {
        return $this->last_login_at;
    }

    /**
     * Get pantries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPantries()
    {
        return $this->pantries;
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}