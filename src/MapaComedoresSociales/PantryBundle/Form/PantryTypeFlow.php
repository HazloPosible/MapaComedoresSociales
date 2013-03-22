<?php
namespace MapaComedoresSociales\PantryBundle\Form;

use Geocoder\GeocoderInterface;

use Craue\FormFlowBundle\Event\PostBindRequestEvent;

use Craue\FormFlowBundle\Form\FormFlowEvents;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Craue\FormFlowBundle\Form\FormFlow;

class PantryTypeFlow extends FormFlow implements EventSubscriberInterface
{
    protected $maxSteps = 2;
    protected $allowDynamicStepNavigation = true;

    protected function loadStepDescriptions() {
        return array(
                'General data',
                'Check Map'
        );
    }

    public function setEventDispatcher(EventDispatcherInterface $dispatcher) {
        parent::setEventDispatcher($dispatcher);
        $dispatcher->addSubscriber($this);
    }

    public static function getSubscribedEvents() {
        return array(
                FormFlowEvents::POST_BIND_REQUEST => 'onPostBindRequest',
        );
    }

    public function onPostBindRequest(PostBindRequestEvent $event)
    {
        $data = $event->getFormData();
        $geocoder = $this->getGeocoder();

        try {
            $result = current($geocoder->geocode(sprintf('%s %s', $data->getAddress(), $data->getZip()))->getResults());
            $location = $result->getGeometry()->getLocation();
        } catch (\Exception $e) {
            $result = current($geocoder->geocode(sprintf('%s', $data->getAddress()))->getResults());
            $location = $result->getGeometry()->getLocation();
        } catch (\Exception $e) {
            // log?
        }

        $data->setLatitude($location->getLatitude());
        $data->setLongitude($location->getLongitude());
    }

    public function setGeocoder(GeocoderInterface $geocoder)
    {
        $this->geocoder = $geocoder;
    }

    public function getGeocoder()
    {
        return $this->geocoder;
    }
}