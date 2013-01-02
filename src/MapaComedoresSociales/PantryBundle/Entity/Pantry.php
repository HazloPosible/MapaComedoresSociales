<?php

namespace MapaComedoresSociales\PantryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * MapaComedoresSociales\PantryBundle\Entity\Pantry
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pantry
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
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string $zip
     *
     * @ORM\Column(name="zip", type="string", length=8)
     */
    private $zip;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="MapaComedoresSociales\GeoLocationBundle\Entity\GeoArea")
     * @ORM\JoinColumn(name="geoarea_id", referencedColumnName="id", nullable=false)
     */
    private $geoarea;

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
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="MapaComedoresSociales\UserBundle\Entity\User", inversedBy="pantries", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="MapaComedoresSociales\CommentBundle\Entity\Comment", mappedBy="pantry")
     **/
    private $comments;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

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
     * @return Pantry
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
     * Set description
     *
     * @param string $description
     * @return Pantry
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Pantry
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Pantry
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Pantry
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
     * Set id_geoarea_fk
     *
     * @param string $idGeoareaFk
     * @return Pantry
     */
    public function setIdGeoareaFk($idGeoareaFk)
    {
        $this->id_geoarea_fk = $idGeoareaFk;
    
        return $this;
    }

    /**
     * Get id_geoarea_fk
     *
     * @return string 
     */
    public function getIdGeoareaFk()
    {
        return $this->id_geoarea_fk;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createAt
     * @return Pantry
     */
    public function setCreateAt($createAt)
    {
        $this->created_at = $createAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreateAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updateAt
     * @return Pantry
     */
    public function setUpdateAt($updateAt)
    {
        $this->updated_at = $updateAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updated_at;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Pantry
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
     * @return Pantry
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Pantry
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set geoarea
     *
     * @param \MapaComedoresSociales\GeoAreaBundle\Entity\GeoArea $geoarea
     * @return Pantry
     */
    public function setGeoarea(\MapaComedoresSociales\GeoAreaBundle\Entity\GeoArea $geoarea)
    {
        $this->geoarea = $geoarea;
    
        return $this;
    }

    /**
     * Get geoarea
     *
     * @return \MapaComedoresSociales\GeoAreaBundle\Entity\GeoArea 
     */
    public function getGeoarea()
    {
        return $this->geoarea;
    }

    /**
     * Set user
     *
     * @param \MapaComedoresSociales\UserBundle\Entity\User $user
     * @return Pantry
     */
    public function setUser(\MapaComedoresSociales\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \MapaComedoresSociales\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add comments
     *
     * @param \MapaComedoresSociales\CommentBundle\Entity\Comment $comments
     * @return Pantry
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
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}