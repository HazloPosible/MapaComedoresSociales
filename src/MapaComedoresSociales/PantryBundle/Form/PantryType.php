<?php

namespace MapaComedoresSociales\PantryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PantryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
<<<<<<< HEAD
        $builder
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('latitude')
            ->add('longitude')
            ->add('email')
            ->add('type')
        ;
=======
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
>>>>>>> 5dc93d3a912c30ecd8c82e223c62d2ad2d26fa94
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MapaComedoresSociales\PantryBundle\Entity\Pantry'
        ));
    }

    public function getName()
    {
        return 'mapacomedoressociales_pantrybundle_pantrytype';
    }
}
