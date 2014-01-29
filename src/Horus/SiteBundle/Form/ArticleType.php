<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ArticleType
 * @package Horus\SiteBundle\Form
 */
class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('attr' => array('placeholder' => "Nom de l'article")))
                ->add('tags', null, array( 'label' => 'Mots-clefs associés'))
                ->add('home', 'checkbox', array('required' => false, 'label' => "Visible en page d'accueil"))
                ->add('produits', null, array( 'label' => 'Produits associés'))
                ->add('pages', null, array( 'label' => 'Pages associés'))
                ->add('categories')
                ->add('nature','choice', array(
                    'choices'   => array(1 => 'Brouillon', 2 => 'En attente de relecture', 3 => 'Final'),
                    'required'  => true,
                    'expanded' => true
                ))
                ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'RÉsumé en quelques mots')))
                ->add('content', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('isVisible', null, array('required' => false))
                ->add('datePublication', 'date', array('widget' => 'single_text'));
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
            'data_class' => 'Horus\SiteBundle\Entity\Article',
            'csrf_protection' => false
        ));
    }
}
