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
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $em->remove($user);
        $em->flush();
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
        return $this->userRepository->findUserByUsername;
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
    public function updateUser(UserInterface $user) 
    {
        // TODO: Must be studied
    }

    /**
     * {@inheritDoc}
     */
    public function reloadUser(UserInterface $user)
    {
        $this->em->refresh($user);
    }

    /**
    * {@inheritDoc}
    */
    public function updatePassword(UserInterface $user) 
    {
        $encoder = $this->encoderFactory->getEncoder($user);
        $user->setSalt(hash($this->encoding, time() . $user->getPassword()));
        $passwordCoding = $encoder->encodePassword(
            $user->getPassword(),
            $user->getSalt()
        );
        $user->setPassword($passwordCoding);
    }
}