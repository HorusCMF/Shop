<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class TransportType
 * @package Horus\SiteBundle\Form
 */
class TransportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('attr' => array('placeholder' => "Titre")))
            ->add('delay', 'text', array('required' => false, 'attr' => array('placeholder' => "Délai")))
            ->add('url', 'url', array('required' => false, 'attr' => array('placeholder' => "http://www.google.fr")))
            ->add('from', 'text', array('attr' => array('placeholder' => "De")))
            ->add('to', 'text', array('attr' => array('placeholder' => "A")))
            ->add('file', null, array('required' => false))
            ->add('service', 'textarea', array('required' => false, 'attr' => array('class' => 'form-control', 'cols' => 50, 'rows' => 5, 'placeholder' => 'Ex: Garantie, Installation etc... ')))
            ->add('isVisible')
            ->add('tva', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array("0" => 'Aucune taxe', "19.6" => '19.6%', "20" => '20%', "7" => '7%', "10" => '10%', "5.5" => '5.5%', "2.1" => '2.1%'),
                'required' => true,
                'preferred_choices' => array('19.6')
            ))
            ->add('nature', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array(1 => 'Sur le poid', 2 => 'Sur la quantité', 3 => 'Sur le prix'),
                'required' => true
            ))
            ->add('etat', 'choice', array(
                'label' => 'Est-il actif?',
                'choices' => array(0 => 'Inactif', 1 => 'Actif'),
                'required' => true,
                'expanded' => true
            ))
            ->add('manutention', 'choice', array(
                'label' => 'Frais de manutention?',
                'choices' => array(0 => 'Non', 1 => 'Oui'),
                'required' => true,
                'expanded' => true
            ))
            ->add('extras', 'textarea', array('required' => false,'attr' => array('rows' => 5, 'cols' => 35, 'placeholder' => "Votre commentaire")))
            ->add('longueur', 'text', array('required' => false, 'attr' => array('placeholder' => "Ex: 14"), 'label' => "Longueur maximum "))
            ->add('largeur', 'text', array('required' => false, 'attr' => array('placeholder' => "Ex: 10"), 'label' => "Largeur maximum "))
            ->add('hauteur', 'text', array('required' => false, 'attr' => array('placeholder' => "Ex: 16"), 'label' => "Hauteur maximum "))
            ->add('profondeur', 'text', array('required' => false, 'attr' => array('placeholder' => "Ex: 18"), 'label' => "Profondeur maximum "))
            ->add('departement', null, array(
                'empty_value' => 'Tous les départements',
            ))
            ->add('video', 'text', array('required' => false, 'attr' => array('placeholder' => "http://www.youtube.com/watch?v=Ry0aHEAH_ug")))
            ->add('delay', 'text', array('required' => false, 'attr' => array('placeholder' => "Délai en jours")))
            ->add('content', 'textarea', array('required' => false, 'attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')));
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
            'data_class' => 'Horus\SiteBundle\Entity\Transports',
            'csrf_protection' => false
        ));
    }
}
