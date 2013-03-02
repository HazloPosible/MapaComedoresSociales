<?php

namespace MapaComedoresSociales\PantryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MapaComedoresSociales\GeoLocationBundle\Form\GeoAreaRegisterType;

class PantryRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('email')
            ->add('geoarea', new GeoAreaRegisterType(), array(
                'data_class' => 'MapaComedoresSociales\GeoLocationBundle\Entity\GeoArea'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MapaComedoresSociales\PantryBundle\Entity\Pantry'
        ));
    }

    public function getName()
    {
        return 'Pantry_Register';
    }
}
