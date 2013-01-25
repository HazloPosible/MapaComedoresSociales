<?php

namespace MapaComedoresSociales\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('password')
            ->add('salt')
            ->add('email')
            ->add('isEnable')
            ->add('isActive')
            ->add('created_at')
            ->add('updated_at')
            ->add('last_login_at')
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
        return 'mapacomedoressociales_userbundle_usertype';
    }
}
