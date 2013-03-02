<?php

namespace MapaComedoresSociales\FrontendBundle\Controller;
use Ivory\GoogleMap\Overlays\InfoWindow;

use Ivory\GoogleMap\Overlays\Animation;

use MapaComedoresSociales\PantryBundle\Form\PantryFilterType;

use MapaComedoresSociales\PantryBundle\Form\PantryType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $pantryForm = $this->createForm(new PantryType());
        $map = $this->get('ivory_google_map.map');
        $panControl = $this->get('ivory_google_map.pan_control');
        $map->setPanControl($panControl);
        $map->setPanControl(ControlPosition::TOP_LEFT);

        $marker = $this->get('ivory_google_map.marker');

        //@TODO: Use marker clustering with javascript library
        //@see https://code.google.com/p/google-maps-utility-library-v3

        // Markers TEST
        // Configure your marker options
        $marker->setPosition(41.3809434, 2.1676915, true);
        $marker->setAnimation(Animation::DROP);

        $marker
                ->setOptions(
                        array('clickable' => true, 'flat' => true));

        $infoWindow = new InfoWindow();
        $infoWindow->setContent('CONTENIDO!');

        $marker->setInfoWindow($infoWindow);

        $map->addMarker($marker);
        $marker = $this->get('ivory_google_map.marker');
        $marker->setPosition(41.3719434, 2.1625344, true);
        $marker->setAnimation(Animation::DROP);

        $marker
                ->setOptions(
                        array('clickable' => true, 'flat' => true));
        $infoWindow = new InfoWindow();
        $infoWindow->setContent('CONTENIDO!');

        $marker->setInfoWindow($infoWindow);
        $map->addMarker($marker);
        $pantryFilterForm = $this->createForm(new PantryFilterType());

        return $this
                ->render('FrontendBundle:Default:index.html.twig',
                        array('pantryForm' => $pantryForm->createView(),
                                'map' => $map,
                                'pantryFilterForm' => $pantryFilterForm
                                        ->createView()));
    }
}

