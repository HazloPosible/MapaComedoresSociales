<?php 

namespace MapaComedoresSociales\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MapaComedoresSociales\Entity\User;

class Users implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$users = array(
			array('' => '', '' => ''),
			array('' => '', '' => ''),
			array('' => '', '' => ''),
			array('' => '', '' => ''),
			array('' => '', '' => ''),
			//...
		);

	}



}