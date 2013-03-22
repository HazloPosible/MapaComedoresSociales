<?php

namespace MapaComedoresSociales\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    private $name;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    private $lastname;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="MapaComedoresSociales\PantryBundle\Entity\Pantry", mappedBy="user")
     */
    private $pantries;

    /**
     * @ORM\OneToMany(targetEntity="MapaComedoresSociales\CommentBundle\Entity\Comment", mappedBy="user")
     */
    private $comments;

    public function __construct()
    {
        parent::__construct();
        $this->pantries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
}
