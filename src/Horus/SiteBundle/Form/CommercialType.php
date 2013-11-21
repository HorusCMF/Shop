<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CommercialType
 * @package Horus\SiteBundle\Form
 */
class CommercialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('attr' => array('placeholder' => "Titre de l'action commerciale")))
                ->add('category')
                ->add('produit')
                ->add('remiseNet')
                ->add('remiseVar')
                ->add('offert')
                ->add('nature','choice', array(
                    'choices'   => array(1 => 'Remise Nette (€)', 2 => 'Remise Variable (%)', 3 => 'Produit offert (+)'),
                    'required'  => true,
                ))
                ->add('content', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('isVisible', null, array('required' => false))
                ->add('datePublication', 'date', array('widget' => 'single_text','attr' => array('class' => 'date')));
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
            'data_class' => 'Horus\SiteBundle\Entity\Commercial',
            'csrf_protection' => false
        ));
    }
}
