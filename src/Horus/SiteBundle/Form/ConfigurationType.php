<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CommercialType
 * @package Horus\SiteBundle\Form
 */
class ConfigurationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('attr' => array('placeholder' => "Nom")))
            ->add('etat')
            ->add('prenom', 'text', array('attr' => array('placeholder' => "Prénom")))
            ->add('email', 'text', array('attr' => array('placeholder' => "Email")))
            ->add('background', 'text', array('attr' => array('class' => 'colorpicker form-control','placeholder' => "Background")))
            ->add('color', 'text', array('attr' => array('class' => 'colorpicker form-control','placeholder' => "Couleur")))
            ->add('panel', 'text', array('attr' => array('class' => 'colorpicker form-control','placeholder' => "Panel")))
            ->add('url', 'text', array('attr' => array('placeholder' => "Url")))
            ->add('nombreParPage', 'integer', array('attr' => array('placeholder' => "Nombre par page")))
            ->add('montantValide', 'integer', array('attr' => array('placeholder' => "Montant valide")))
            ->add('emballage')
            ->add('horsStock')
            ->add('quantity')
            ->add('orderBy', 'choice', array(
                'choices' => array(0 => 'Croissant', 1 => 'Décroissant'),
                'required' => true,
            ))
            ->add('jourNouveau')
            ->add('entreprise', 'text', array('attr' => array('placeholder' => "Entreprise")));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Configuration',
            'csrf_protection' => false
        ));
    }
}
