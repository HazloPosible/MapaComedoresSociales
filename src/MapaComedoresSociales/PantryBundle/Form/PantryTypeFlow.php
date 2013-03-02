<?php
namespace MapaComedoresSociales\PantryBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;

class PantryTypeFlow extends FormFlow
{
    protected $maxSteps = 2;
    protected $allowDynamicStepNavigation = true;

    protected function loadStepDescriptions() {
        return array(
                'General data',
                'Check Map'
        );
    }
}