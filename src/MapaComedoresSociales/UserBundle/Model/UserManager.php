<?php

namespace MapaComedoresSociales\UserBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserManager
{

	protected $em;
	protected $encoderFactory;
	protected $encoding;

	public function __construct(EntityManager $em, EncoderFactoryInterface $encoderFactory, $encoding)
	{
		$this->em = $em;
        $this->encoderFactory = $encoderFactory;
        $this->encoding = $encoding;
	}

	public function updatePassword(UserInterface $user)
    {
        $encoder = $this->encoderFactory->getEncoder($user);
        $user->setSalt(hash($this->encoding, time() . $user->getPassword()));
        $passwordCoding = $encoder->encodePassword(
				$user->getPassword(),
				$user->getSalt()
		);
        $user->setPassword($passwordCoding);
        //$user->eraseCredentials();
    }

}