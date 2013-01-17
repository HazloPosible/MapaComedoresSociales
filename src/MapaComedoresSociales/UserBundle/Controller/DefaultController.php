<?php

namespace MapaComedoresSociales\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{

	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		$error = $request->attributes->get(
			SecurityContext::AUTENTICATION_ERROR,
			$session->get(SecurityContext::AUTENTICATION_ERROR)

		);

		return $this->render('UserBudnle:Default:login.html.twig', array(
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error' => $error 
			)
		);

	}

	public function loginBoxAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		$error = $request->attributes->get(
			SecurityContext::AUTENTICATION_ERROR,
			$session->get(SecurityContext::AUTENTICATION_ERROR)

		);

		return $this->render('UserBudnle:Default:login.html.twig', array(
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error' => $error 
			)
		);

	}


}
