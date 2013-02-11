<?php

namespace MapaComedoresSociales\PantryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MapaComedoresSociales\PantryBundle\Entity\Pantry;
use MapaComedoresSociales\PantryBundle\Form\RegisterType;

class DefaultController extends Controller {

    public function registerAction() {
        $request = $this->getRequest();

        $pantry = new Pantry();
        $form = $this->createForm(new RegisterType(), $pantry);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {

                return $this->redirect($this->generateUrl('user'));

            }
        }
        return $this->render(
            'PantryBundle:Default:register.html.twig',
            array('from' => $form->createView())
        );
    }

}
