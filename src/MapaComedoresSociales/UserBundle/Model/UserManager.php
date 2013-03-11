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
class UserManager implements UserManagerInterface {

    protected $em;
    protected $encoderFactory;
    protected $encoding;

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
    }


    /**
    * {@inheritDoc}
    */
    public function createUser() {

    }

    /**
    * {@inheritDoc}
    */
    public function deleteUser() {

    }

    /**
    * {@inheritDoc}
    */
    public function findUserBy(array $criteria) {

    }

    /**
    * {@inheritDoc}
    */
    public function findUserByUsername($username) {

    }

    /**
    * {@inheritDoc}
    */
    public function updateUser(UserInterface $user) {

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