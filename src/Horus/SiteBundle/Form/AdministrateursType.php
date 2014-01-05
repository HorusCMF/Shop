<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdministrateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $minDob = new \DateTime('-18 Years');
        $maxDob = new \DateTime('-90 Years');

        $builder
            ->add('gender', 'choice', array(
                'label' => 'Sexe',
                'choices' => array(0 => 'Homme', 1 => 'Femme'),
                'required' => true,
                'expanded' => true
            ))
            ->add('groups')
            ->add('lastname', null, array('required' => true, 'label' => 'Nom', 'attr' => array('pattern' => '.{2,}', 'placeholder' => 'Nom')))
            ->add('firstname', null, array('required' => true, 'label' => 'Prénom', 'attr' => array('pattern' => '.{2,}', 'placeholder' => 'Prénom')))
            ->add('entreprise', null, array('required' => false, 'label' => 'Entreprise', 'attr' => array('pattern' => '.{2,}', 'placeholder' => 'Entreprise')))
            ->add('description', 'textarea', array('required' => false, 'attr' => array('class' => 'ckeditor','rows' => 5, 'cols' => 35, 'placeholder' => 'Description complète')))
            ->add('adresse', null, array('attr' => array('placeholder' => 'Adresse')))
            ->add('zipcode', 'text', array('required' => false, 'label' => 'Code Postal', 'attr' => array('placeholder' => 'Ex: 75001')))
            ->add('ville', null, array('required' => false, 'attr' => array('pattern' => '.{2,}', 'placeholder' => 'Ville')))
            ->add('email', 'email', array('required' => true, 'attr' => array('placeholder' => 'Email')))
            ->add('tel', null, array('label' => 'Téléphone', 'attr' => array('placeholder' => '06XXXXXXXX',  'maxlength' => 17), 'required' => false))
            ->add('password', 'repeated', array(
                'required' => false,
                'attr' => array('autcomplete', 'off'),
                'type' => 'password',
                'first_name' => 'mdp',
                'second_name' => 'mdp_conf',
                'invalid_message' => "Le mot de passe n'est pas le même",
                'error_bubbling' => true,
                'first_options' => array('label' => 'Mot de passe', 'attr' => array('value' => '','autcomplete', 'off','placeholder' => 'Au moins 6 caractères', 'pattern' => '.{6,}')),
                'second_options' => array('label' => 'Confirmation du mot de passe', 'attr' => array('value' => '','autcomplete', 'off','placeholder' => 'Retaper votre mot de passe', 'pattern' => '.{6,}'))
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Administrateur',
            'csrf_protection' => false

        ));
    }

    public function getName()
    {
        return '';
    }
}
