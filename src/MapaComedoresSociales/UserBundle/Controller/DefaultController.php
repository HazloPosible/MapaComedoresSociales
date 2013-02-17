<?php

namespace MapaComedoresSociales\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use MapaComedoresSociales\UserBundle\Entity\User;
use MapaComedoresSociales\UserBundle\Form\RegisterType;

class DefaultController extends Controller
{
	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		$error = $request->attributes->get(
			SecurityContext::AUTHENTICATION_ERROR,
			$session->get(SecurityContext::AUTHENTICATION_ERROR)
		);

		return $this->render('UserBundle:Default:login.html.twig', array(
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

	public function registerAction()
	{
		$request = $this->getRequest();

		$user = new User();
		$form = $this->createForm(new RegisterType(), $user);

		if ($request->getMethod() == 'POST') {
			$form->bind($request);

			if($form->isValid()) {
				$userManager = $this->get('user_manager');
				$userManager->updatePassword($user);
				$user->setEnabled(true);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();

				return $this->redirect($this->generateUrl('user'));
			}
		}

		return $this->render(
			'UserBundle:Default:register.html.twig',
			array('form' => $form->createView())
		);
	}
}
