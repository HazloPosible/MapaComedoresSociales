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
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Password confirmation'),
                'invalid_message' => 'Las contraseñas no coinciden',
                'options' => array('label' => 'password')
            ))
            ->add('email', 'repeated', array(
                'type' => 'email',
                'first_options' => array('label' => 'Email'),
                'second_options' => array('label' => 'Email confirmation'),
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
