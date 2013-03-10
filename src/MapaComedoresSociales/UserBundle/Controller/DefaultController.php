<?php

namespace MapaComedoresSociales\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use MapaComedoresSociales\UserBundle\Entity\User;
use MapaComedoresSociales\UserBundle\Form\RegisterType;
use MapaComedoresSociales\UserBundle\Form\RememberPasswordType;
use MapaComedoresSociales\UserBundle\Form\ChangePasswordType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller {

	public function loginAction() {

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

	public function loginBoxAction() {

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

	public function registerAction() {

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

	// TODO: need check and refactor
    public function rememberPasswordAction() {

        $request = $this->getRequest();

        $form = $this->createForm(new RememberPasswordType());

        if ($request->isMethod('POST')) {
        	
        	$data = $form->bind($request)->getData();
			$repository = $this->getDoctrine()->getRepository('UserBundle:User');
        	$user = $repository->findOneByEmail($data['email']);

        	if ($user) {
        		// TODO: Check
        		$message = \Swift_Message::newInstance()
        			->setSubject('Hello Email')
        			->setFrom('send@example.com')
        			->setTo('recipient@example.com')
        			->setBody(
        				$this->renderView(
        					'UserBundle:Default:email_remember_password.txt.twig',
        					array('name' => $user->getName())
        				)
        			);
     
        		$this->get('mailer')->send($message);
				$this->get('session')->getFlashBag()->add('notice', 'Your email was send!');
        	
        	} else {
				$this->get('session')->getFlashBag()->add('error', 'The email ['.$data['email'].'] not exsist!');
			}

			return $this->redirect($this->generateUrl('user_remember'));
        }

        return $this->render(
        	'UserBundle:Default:remember.html.twig',
        	array('form' => $form->createView())
        );
    }

    public function changePasswordAction() {

        $user = $this->get('security.context')->getToken()->getUser();
    	if (!is_object($user) || !$user instanceof User) {
    		throw new AccessDeniedException('Este usuario no tiene permisos de acceso a esta sección');
    	}

    	$request = $this->getRequest();
    	$form = $this->createForm(new ChangePasswordType());

    	if ($request->isMethod('POST')) {

            $data = $form->bind($request)->getData();
                
   
            
            $user->setPassword($data['password']);
            $userManager = $this->get('user_manager');
            $userManager->updatePassword($user);

    		$em = $this->getDoctrine()->getEntityManager();
    		$em->persist($user);
    		$em->flush();
    	}

    	return $this->render(
        	'UserBundle:Default:change_password.html.twig',
        	array('form' => $form->createView())
        );

    }


}
