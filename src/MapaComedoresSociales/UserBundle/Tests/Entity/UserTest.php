<?php 

namespace MapaComedoresSociales\UserBundle\Tests\Entity;

use Symfony\Component\Validator\Validation;
use MapaComedoresSociales\UserBundle\Entity\User;
use MapaComedoresSociales\PantryBundle\Entity\Pantry;

/**
* User Test 
* 
*
* @author   Manuel A. Gonzalez Yanes <mgonyan@gmail.com>
* @license  
* @link  	https://github.com/HazloPosible/MapaComedoresSociales   
*/
class UserTest extends \PHPUnit_Framework_TestCase
{
	private $validator;

	protected function setUp()
	{
		$this->validator = Validation::createValidatorBuilder()
			->enableAnnotationMapping()
			->getValidator();
	}

	// name

	public function testName()
	{
		$user = New User();
		$this->assertNull($user->getName());

		$user->setName('Manuel Alejandro');
		$userName = $user->getName();
		$this->assertEquals('Manuel Alejandro', $userName);
	}

	public function testNameValidation()
	{
		$user = New User();

		// Not blank
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(), 'The user name must have some text');

		$error = $errors[0];
		$this->assertEquals('This value should not be blank.', $error->getMessage());
		$this->assertEquals('name', $error->getPropertyPath());

		// String user name Longitude
		$user->setName('Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
			sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi 
			ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
			in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
			sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
			mollit anim id est laborum');
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(),
			'The name value should not be greater than 255 charaters'
		);

		$error = $errors[0];
		$this->assertRegExp("/This value is too long/", $error->getMessage());
		$this->assertEquals('name', $error->getPropertyPath());
	}

	// lastName

	public function testLastname()
	{
		$user = New User();
		$this->assertNull($user->getLastname());

		$user->setLastname('Gonzalez Yanes');
		$userLastname = $user->getLastname();
		$this->assertEquals('Gonzalez Yanes', $userLastname);
	}

	public function testLastnameValidation()
	{
		$user = New User();
		$user->setName('Manuel Alejandro');

		// Not blank
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(), 'The user lastname must have some text');

		$error = $errors[0];
		$this->assertEquals('This value should not be blank.', $error->getMessage());
		$this->assertEquals('lastname', $error->getPropertyPath());

		// String user name Longitude
		$user->setLastname('Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
			sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi 
			ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
			in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
			sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
			mollit anim id est laborum');
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(),
			'The name value should not be greater than 255 charaters'
		);

		$error = $errors[0];
		$this->assertRegExp("/This value is too long/", $error->getMessage());
		$this->assertEquals('lastname', $error->getPropertyPath());
	}

	// Email

	public function testEmail()
	{
		$user = New User();
		$this->assertNull($user->getEmail());

		// Setter a Getter
		$user->setEmail('mgonyan@gmail.com');
		$userEmail = $user->getEmail();
		$this->assertEquals('mgonyan@gmail.com', $userEmail);
	}

	public function testEmailValidation()
	{
		$user = New User();
		$user->setName('Manuel Alejandro');
		$user->setLastname('Gonzalez Yanes');

		// Not blank
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(), 'The user email should not be blank.');

		$error = $errors[0];
		$this->assertEquals('This value should not be blank.', $error->getMessage());
		$this->assertEquals('email', $error->getPropertyPath());



		// Check valid emails
		$user->setEmail('not_email@');
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(), 'The user email is not a valid email address.');

		$error = $errors[0];
		$this->assertEquals('This value is not a valid email address.', $error->getMessage());
		$this->assertEquals('email', $error->getPropertyPath());

		// Check MX email
		$user->setEmail('mgonyan@gasdewerasd.awe');
		$errors = $this->validator->validate($user);
		$this->assertGreaterThan(0, $errors->count(), 'The user email domian is not valid.');

		$error = $errors[0];
		$this->assertEquals('This value is not a valid email address.', $error->getMessage());
		$this->assertEquals('email', $error->getPropertyPath());
	}

	// UserName
	public function testUserName()
	{
		$user = New User();
		$this->assertNull($user->getUsername());

		$user->setEmail('mgonyan@gmail.com');
		$this->assertEquals('mgonyan@gmail.com', $user->getUsername());
	}

	// password
	// plainPassword
	// salt

	public function testSalt()
	{
		$user = New User();
		$this->assertNull($user->getUsername());

		$user->setSalt('asdeeeqqwe2465');
		$salt = $user->getSalt();

		$this->assertEquals('asdeeeqqwe2465', $salt);
	}

	// pantries

	public function testPantries()
	{

	}

	// comments

	public function credentialsExpireAt()
	{
		
	}	

	// enabled

	public function testEnabled() 
	{
		$user = New User();
		$this->assertFalse($user->getEnabled());

		$user->setEnabled(true);
		$this->assertEquals(true, $user->getEnabled());
	}

	// active

	public function testActive() 
	{
		$user = New User();
		$this->assertFalse($user->getActive());

		$user->setActive(false);
		$this->assertEquals(false, $user->getActive());
	}

	// createdAt

	public function createdAt()
	{

	}

	// updatedAt

	public function updatedAt()
	{

	}

	// credentialsExpireAt

	public function credentialsExpireAt()
	{

	}	

	// lastLoginAt

	public function credentialsExpireAt()
	{
		
	}	

	// confirmationToken

	public function credentialsExpireAt()
	{
		
	}	

	// expired

	public function credentialsExpireAt()
	{
		
	}	

	// expiresAt

	public function credentialsExpireAt()
	{
		
	}	


}