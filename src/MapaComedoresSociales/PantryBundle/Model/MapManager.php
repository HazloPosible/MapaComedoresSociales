<?php

namespace MapaComedoresSociales\PantryBundle\Model;

use Ivory\GoogleMap\Controls\PanControl;

use Ivory\GoogleMap\Controls\MapTypeControl;

use Doctrine\ORM\EntityManager;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Overlays\InfoWindow;

class MapManager
{
    protected $em;
    protected $map;

    public function __construct(EntityManager $em, Map $map, PanControl $panControl, MapTypeControl $mapTypeControl, $repositoryClassName)
    {
        $this->em = $em;
        $this->map = $map;
        $this->mapTypeControl = $mapTypeControl;
        $this->panControl = $panControl;
        $this->repo = $this->em->getRepository($repositoryClassName);
    }

    public function getMap()
    {
        $this->configure();
        $this->populateMap();

        return $this->map;
    }

    protected function configure()
    {
        $this->map->setMapTypeControl($this->mapTypeControl);
        $this->map->setPanControl($this->panControl);
    }

    protected function createMarker()
    {
        $marker = new Marker();
        $marker->setOptions(array('clickable' => true, 'flat' => true));

        return $marker;
    }

    protected function getPantries()
    {
        // maybe with active = true?
        return $this->repo->findAll();
    }

    protected function populateMap()
    {
        $pantries = $this->getPantries();

        foreach ($pantries as $pantry) {
            $marker = $this->createMarker();
            $marker->setPosition($pantry->getLatitude(), $pantry->getLongitude(), true);
            $infoWindow = new InfoWindow();
            $infoWindow->setContent($pantry->getDescription());
            $marker->setInfoWindow($infoWindow);

            $this->map->addMarker($marker);
        }
    }
}
