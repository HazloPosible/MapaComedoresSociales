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
     * findUserBy
     * 
     * @param mixed \array Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function findUserBy(array $criteria);

    /**
     * findUserByUsername
     * 
     * @param mixed $username Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function findUserByUsername($username);

    /**
     * findUsers
     * 
     * @access public
     *
     * @return mixed Value.
     */
    public function findUsers();

    /**
     * updateUser
     * 
     * @param mixed \UserInterface Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function updateUser(UserInterface $user);

    /**
     * reloadUser
     * 
     * @param mixed \UserInterface Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function reloadUser(UserInterface $user);

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


