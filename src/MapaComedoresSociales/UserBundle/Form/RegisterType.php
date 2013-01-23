<?php

namespace MapaComedoresSociales\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las contraseñas no coinciden',
                'options' => array('label' => 'password')
            ))
            ->add('email', 'repeated', array(
                'type' => 'email',
                'invalid_message' => 'Los emails no coinciden',
                'options' => array('label' => 'email')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MapaComedoresSociales\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'mapacomedoressociales_userbundle_registertype';
    }
}
