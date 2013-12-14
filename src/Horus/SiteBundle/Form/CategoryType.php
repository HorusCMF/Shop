<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CategoryType
 * @package Horus\SiteBundle\Form
 */
class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', 'text', array('attr' => array('placeholder' => "Nom de la catégorie")))
                ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
                ->add('position', 'integer', array('required' => false,'label' => 'Positionnement', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 15')))
                ->add('description', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('parent', 'entity', array(
                    'class' => 'HorusSiteBundle:Category',
                    'property' => 'OptionLabel',
                    'required' => false,
                    'empty_value' => 'Choisissez une catégorie parente',
                    'label' => 'Catégorie parente'
            ))
                ->add('articles');
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
            'data_class' => 'Horus\SiteBundle\Entity\Category',
            'csrf_protection' => false
        ));
    }
}
