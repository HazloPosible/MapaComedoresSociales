<?php

namespace MapaComedoresSociales\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;

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
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword; 

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
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var boolean $active
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timesta(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;    

    /**
     * @var \DateTime credentialsExpireAt
     *
     * @ORM\Column(name="credentialsExpireAt", type="datetime", nullable=true)
     */
    private $credentialsExpireAt;

    /**
     * @var \DateTime $lastLoginAt
     *
     * @ORM\Column(name="lastLoginAt", type="datetime", nullable=true)
     */
    private $lastLoginAt;

    /**
     * Random string sent to the user email address in order to verify it
     *
     * @var string $confirmationToken
     *
     * @ORM\Column(name="confirmationToken", type="string", length=255)
     */
    private $confirmationToken;   

    /**
     * @var boolean $credentialsExpired
     *
     * @ORM\Column(name="credentialsExpired", type="boolean")
     */
    private $credentialsExpired;    

    /**
     * @var boolean $expired
     *
     * @ORM\Column(name="expired", type="boolean")
     */
    private $expired;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->pantries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->active = false;
        $this->expired = false;
        $this->enabled = false;
        $this->credentialsExpired = false;
    }

    /**
     * Return name + lastname for relationships
     *
     * @param void
     * @return String
     */
    public function __toString()
    {
        return (string) $this->getName().', '.$this->getLastname();
    }

    /**
     * Add pantries
     *
     * @param \MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries
     * @return User
     */
    public function addPantries(\MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries)
    {
        $this->pantries[] = $pantries;

        return $this;
    }

    /**
     * Remove pantries
     *
     * @param \MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries
     */
    public function removePantries(\MapaComedoresSociales\PantryBundle\Entity\Pantry $pantries)
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

    ////////////////
    // UserInterface
    ////////////////

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Gets the encrypted password.
     * 
     * @access public
     *
     * @return string.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritDoc}
     */
    function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user
     * 
     * @access public
     *
     * @return void.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    ////////////////////////
    // AdvancedUserInterface
    ////////////////////////
    
    /**
     * {@inheritDoc}
     */
    public function isAccountNonExpired()
    {        
        if ($this->expired === true) {
            return false;
        }

        if ($this->expiresAt && $this->expiresAt->getTimestamp() < time() !== null) {
            return false;
        }
        
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonLocked()
    {
        return $this->actived;
    }

    /**
     * {@inheritDoc}
     */
    public function isCredentialsNonExpired()
    {
        return !$this->isCredentialsNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled()
    {
        if (!$this->active) {

            throw new DisabledException('Account is disabled');
        }
        return $this->active;
    }

    /**
     * {@inheritDoc}
     */
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
     * Get isAactive
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Get isEnable
     *
     * @return boolean
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /*================================
    *      GENERATED
    *=================================
    */

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
     * Set enable
     *
     * @param boolean $enable
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (Boolean) $enabled;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set isAactive
     *
     * @param boolean $isAactive
     * @return User
     */
    public function setActive($active)
    {
        $this->active = (Boolean) $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get Credentials Expire At
     * 
     * @access public
     *
     * @return \DateTime.
     */
    public function getcredentialsExpireAt()
    {
        return $this->getcredentialsExpireAt;
    }

    /**
     * Set Credentials Expire At
     * 
     * @access public
     *
     * @return \DateTime.
     */
    public function setcredentialsExpireAt($credentialsExpireAt)
    {
        return $this->getcredentialsExpireAt = $credentialsExpireAt;
    }

    /**
     * Get lastLoginAt
     *
     * @return \DateTime
     */
    public function getLastLoginAt()
    {
        return $this->lastLoginAt;
    }

    /**
     * Set lastLoginAt
     *
     * @param \DateTime $lastLoginAt
     * @return User
     */
    public function setLastLoginAt($lastLoginAt)
    {
        $this->lastLoginAt = $lastLoginAt;

        return $this;
    }

    /**
     * Get ConfirmationToken
     * 
     * @access public
     * @return string.
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set ConfirmationToken
     * 
     * @param string $confirmationToken.
     *
     * @access public
     * @return string.
     */
    public function setConfirmationToken($confirmationToken)
    {
        return $this->confirmationToken = $confirmationToken;
    }  

    /**
     * Get ConfirmationToken
     * 
     * @access public
     * @return boolean.
     */
    public function getCredentialsExpired()
    {
        return $this->credentialsExpired;
    }

    /**
     * Set credentialsExpired
     * 
     * @param boolean $credentialsExpired.
     *
     * @access public
     * @return boolean.
     */
    public function setCredentialsExpired($credentialsExpired)
    {
        return $this->credentialsExpired = (Boolean) $credentialsExpired;
    }  

    /**
     * Get expired
     * 
     * @access public
     * @return boolean.
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set expired
     * 
     * @param boolean $expired.
     *
     * @access public
     * @return boolean.
     */
    public function setExpired($expired)
    {
        return $this->expired = (Boolean) $expired;
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

    /**
     * Set plain password
     * 
     * @param mixed $password Description.
     *
     * @access public
     * @return String.
     */
    public function setPlainPassword($password) 
    {   
        return $this->plainPassword = $password;
    }

    /**
     * Get Plain Password
     * 
     * @access public
     * @return String.
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
}