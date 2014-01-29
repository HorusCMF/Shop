<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class FamilleType
 * @package Horus\SiteBundle\Form
 */
class FamilleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', 'text', array('attr' => array('placeholder' => "Nom de la famille")))
                ->add('keywords', 'textarea', array('required' => false,'attr' => array("class" => "form-control", 'placeholder' => 'Ajouter quelques mots-clefs')))
                ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
                ->add('description', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('file')
                ->add('position', 'integer', array('required' => false,'label' => 'Positionnement', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 15')))
                ->add('parent', 'entity', array(
                    'class' => 'HorusSiteBundle:Famille',
                    'property' => 'OptionLabel',
                    'required' => false,
                    'empty_value' => 'Choisissez une famille parente',
                    'label' => 'Famille parente'
                ))
                ->add('produits');
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
    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Famille',
            'csrf_protection' => false
        ));
    }
}
