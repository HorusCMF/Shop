<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactType
 * @package Horus\SiteBundle\Form
 */
class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
                ->add('subject', 'text', array('attr' => array('placeholder' => "Nom de l'article")))
                ->add('criticite','choice', array(
                        'choices'   => array(
                            0 => 'Bas',
                            1 => 'Normal',
                            2 => 'Haut',
                            3 => 'Urgent',
                            4 => 'Immédiat'
                        ),
                        'required'  => true,
                        'expanded' => false
                ))
                ->add('content', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')));
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
            'csrf_protection' => false
        ));
    }
}
