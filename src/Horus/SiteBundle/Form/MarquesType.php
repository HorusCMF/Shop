<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class MarquesType
 * @package Horus\SiteBundle\Form
 */
class MarquesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('attr' => array('placeholder' => "Titre de la marque")))
                ->add('url', 'url', array('required' => false,'attr' => array('placeholder' => "http://")))
                ->add('keywords', 'text', array('required' => false,'attr' => array('placeholder' => "Mot-clefs de votre marques")))
                ->add('resume', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
                ->add('description', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('file')
                ->add('metaTitle', 'text', array('label' => 'Titre de référencement','required' => false,'attr' => array('placeholder' => "Titre de la marque")))
                ->add('metaDescription', 'textarea', array('label' => 'Description de référencement','required' => false,'attr' => array('class' => 'form-control', 'rows' => 7, 'cols' => 80,'placeholder' => "Description de la marque")))
                ->add('metaKeywords', 'textarea', array('label' => 'Mots-clefs de référencement','required' => false,'attr' => array('class' => 'form-control','rows' => 7, 'cols' => 80,'placeholder' => "Mots Clefs de la marque")))
                ->add('active')
                ->add('parent', 'entity', array(
                    'required' => false,
                    'empty_value' => 'Choisissez une marque parente',
                    'class' => 'HorusSiteBundle:Marques',
                    'property' => 'OptionLabel',
                ));
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
            'data_class' => 'Horus\SiteBundle\Entity\Marques',
            'csrf_protection' => false
        ));
    }
}
