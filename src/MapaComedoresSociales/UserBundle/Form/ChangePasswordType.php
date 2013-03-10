<?php

namespace MapaComedoresSociales\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;

class ChangePasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('current_password', 'password', array(
            'label' => 'Current password',
            'mapped' => false,
            'constraints' => new UserPassword(),
        ));
        
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'first_options' => array('label' => 'New password'),
            'second_options' => array('label' => 'New password confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        
        $resolver->setDefaults(array(
            'data_class' => 'MapaComedoresSociales\UserBundle\Entity\User',
            'intention' => 'change_password'
        ));
    }

    public function getName() {
        
        return '';
    }
}
