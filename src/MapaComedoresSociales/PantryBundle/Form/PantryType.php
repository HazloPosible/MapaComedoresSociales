<?php

namespace MapaComedoresSociales\PantryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PantryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('zip')
            ->add('email')
            ->add('created_at')
            ->add('updated_at')
            ->add('enabled')
            ->add('geoarea')
            ->add('user')
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
        return 'mapacomedoressociales_pantrybundle_pantrytype';
    }
}