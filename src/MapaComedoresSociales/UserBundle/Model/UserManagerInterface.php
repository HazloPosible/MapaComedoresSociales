<?php

namespace MapaComedoresSociales\UserBundle\Model;


/**
* Interface to be implemented by user manager. This adds an addictional
* level of abstracion between.
*
* @uses     
*
* @category Category
* @package  Package
* @author   Manuel A. Gonzalez Yanes <mgonyan@gmail.com>
* @author   Sergio Moya Campaña <smoya69@gmail.com>
* @license  
* @link     
*/
interface UserManagerInterface {
    

    public function createUser();

    public function deleteUser(UserInterface $user);

    public function findUserBy(array $criteria);

    public function findUserByUsername($username);

    public function updateUser(UserInterface $user);

    /**
     * Updates a user password if a plain password is set
     * 
     * @param mixed \User Description.
     *
     * @access public
     *
     * @return void
     */
    public function updatePassword(UserInterface $user);

}


