<?php

namespace MapaComedoresSociales\FrontendBundle\Controller;

use MapaComedoresSociales\PantryBundle\Form\PantryFilterType;
use MapaComedoresSociales\PantryBundle\Form\PantryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $pantryForm = $this->createForm(new PantryType());

        $map = $this->get('mapacomedoressociales.manager.map')->getMap();
        $pantryFilterForm = $this->createForm(new PantryFilterType());

        return $this->render('FrontendBundle:Default:index.html.twig', array(
                'pantryForm' => $pantryForm->createView(),
                'map' => $map,
                'pantryFilterForm' => $pantryFilterForm->createView()
                )
        );
    }
}
