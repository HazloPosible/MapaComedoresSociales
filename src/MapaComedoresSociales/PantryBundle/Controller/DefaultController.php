<?php

namespace MapaComedoresSociales\PantryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MapaComedoresSociales\PantryBundle\Entity\Pantry;
use MapaComedoresSociales\PantryBundle\Form\PantryRegisterType;

class DefaultController extends Controller {

    public function registerAction() {

        $request = $this->getRequest();

        $pantry = new Pantry();
        $geo = new \MapaComedoresSociales\GeoLocationBundle\Entity\GeoArea();

        $form = $this->createForm(new PantryRegisterType(), $pantry);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($pantry);
                $em->persist($geo);
                $em->flush();

                return $this->redirect($this->generateUrl('user'));

            }
        }
        return $this->render(
            'PantryBundle:Default:register.html.twig',
            array('form' => $form->createView())
        );
    }

}
