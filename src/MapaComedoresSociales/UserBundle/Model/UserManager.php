<?php

namespace MapaComedoresSociales\UserBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* Class to allow manage diferent user actions.
*
* @uses     implements
*
* @category Category
* @package  Package
* @author   Manuel A. Gonzalez Yanes <mgonyan@gmail.com>
* @author   Sergio Moya Campaña <smoya69@gmail.com>
* @license
* @link
*/
class UserManager implements UserManagerInterface
{
    protected $em;
    protected $encoderFactory;
    protected $encoding;
    protected $userRepository;

    /**
     * Constructor.
     *
     * @param EntityManager             $em entity manager object at Doctrine.
     * @param EncoderFactoryInterface   $encoderFactory type of encoder for password.
     * @param string                    $encoding string with type of content.
     *
     * @access public
     *
     * @return void.
     */
    public function __construct(EntityManager $em, EncoderFactoryInterface $encoderFactory, $encoding)
    {
        $this->em = $em;
        $this->encoderFactory = $encoderFactory;
        $this->encoding = $encoding;
        $this->userRepository = $em->getRepository('UserBundle:User');
    }

    ///////////////////////
    // UserManagerInterface
    ///////////////////////

    /**
    * {@inheritDoc}
    */
    public function createUser()
    {
        return $this->userRepository;
    }

    /**
    * {@inheritDoc}
    */
    public function deleteUser(UserInterface $user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    /**
    * {@inheritDoc}
    */
    public function persist(UserInterface $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
    * {@inheritDoc}
    */
    public function findUserBy(array $criteria)
    {
        return $this->userRepository->findUserBy($criteria);
    }

    /**
    * {@inheritDoc}
    */
    public function findUserByUsername($username)
    {
        return $this->userRepository->findUserByUsername($username);
    }

    /**
    * {@inheritDoc}
    */
    public function findUsers()
    {
        return $this->userRepository->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function reloadUser(UserInterface $user)
    {
        $this->em->refresh($user);
    }

}