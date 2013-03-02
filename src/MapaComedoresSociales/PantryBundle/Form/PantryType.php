<?php

namespace MapaComedoresSociales\PantryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PantryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['flowStep']) {
            case 1:
                $builder
                    ->add('name')
                    ->add('description')
                    ->add('address')
                    ->add('zip')
                    ->add('email')
                ;
                break;
            case 2:
                $builder
                    ->add('latitude', 'hidden')
                    ->add('longitude', 'hidden')
                ;
                break;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MapaComedoresSociales\PantryBundle\Entity\Pantry',
            'flowStep' => 1
        ));
    }

    public function getName()
    {
        return 'mapacomedoressociales_pantrybundle_pantrytype';
    }
}
