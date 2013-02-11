<?php

namespace MapaComedoresSociales\GeoLocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GeoAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('latitude')
            ->add('longitude')
            ->add('lft')
            ->add('rgt')
            ->add('root')
            ->add('level')
            ->add('created_at')
            ->add('updated_at')
            ->add('parent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MapaComedoresSociales\GeoLocationBundle\Entity\GeoArea'
        ));
    }

    public function getName()
    {
        return 'mapacomedoressociales_geolocationbundle_geoareatype';
    }
}
