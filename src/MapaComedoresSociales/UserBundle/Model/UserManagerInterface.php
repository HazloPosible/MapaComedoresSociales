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
interface UserManagerInterface 
{
    /**
     * Return an empty user.
     * 
     * @access public
     *
     * @return UserInterface
     */
    public function createUser();

    /**
     * Delete an user instance. 
     * 
     * @param UserInterface $user
     *
     * @access public
     *
     * @return void
     */
    public function deleteUser(UserInterface $user);

    /**
     * Find user according to some criteria
     * 
     * @param array $criteria.
     *
     * @access public
     *
     * @return UserInterface $user.
     */
    public function findUserBy(array $criteria);

    /**
     * Find user by Username
     * 
     * @param string $username.
     *
     * @access public
     *
     * @return UserInterface $user.
     */
    public function findUserByUsername($username);

    /**
     * Find all user
     * 
     * @access public
     *
     * @return $users.
     */
    public function findUsers();

    /**
     * updateUserName
     * 
     * @param mixed \UserInterface Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function updateUserName(UserInterface $user);

    /**
     * Update user information
     * 
     * @param UserInterface $user.
     *
     * @access public
     *
     * @return void.
     */
    public function updateUser(UserInterface $user);

    /**
     * Reload user entity
     * 
     * @param UserInterface $user.
     *
     * @access public
     *
     * @return void.
     */
    public function reloadUser(UserInterface $user);

    /**
     * Updates a user password if a plain password is set
     * 
     * @param UserInterface $user.
     *
     * @access public
     *
     * @return void
     */
    public function updatePassword(UserInterface $user);
}


