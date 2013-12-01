<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class FournisseursType
 * @package Horus\SiteBundle\Form
 */
class FournisseursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('attr' => array('placeholder' => "Titre de la marque")))
                ->add('resume', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
                ->add('description', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('file')
                ->add('metaTitle', 'text', array('required' => false, 'attr' => array('placeholder' => "Titre de la marque")))
                ->add('metaDescription', 'textarea', array('required' => false, 'attr' => array('class' => 'form-control', 'rows' => 7, 'cols' => 80,'placeholder' => "Description de la marque")))
                ->add('metaKeywords', 'textarea', array('required' => false, 'attr' => array('class' => 'form-control','rows' => 7, 'cols' => 80,'placeholder' => "Mots Clefs de la marque")))
                ->add('active');
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
            'data_class' => 'Horus\SiteBundle\Entity\Fournisseurs',
            'csrf_protection' => false
        ));
    }
}
