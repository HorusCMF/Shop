<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class MetaType
 * @package Horus\SiteBundle\Form
 */
class MetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('label' => "Titre de la caractéristique",'required' => false,'attr' => array( 'placeholder' => 'Titre de la caractéristique')))
                ->add('content', 'textarea', array('label' => "Contenu de la caractéristique",'required' => false,'attr' => array('class' => 'form-control','cols' => 100, 'rows' => 6,'placeholder' => 'Contenu de la caractéristique')));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'meta';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Meta',
            'csrf_protection' => false
        ));
    }
}
