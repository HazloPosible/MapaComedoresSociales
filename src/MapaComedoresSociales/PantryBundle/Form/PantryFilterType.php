<?php

namespace MapaComedoresSociales\PantryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PantryFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('location', 'text', array('required' => true, 'label' => 'Localización'));
    }

    public function getName()
    {
        return 'mapacomedoressociales_pantrybundle_pantryfiltertype';
    }
}
