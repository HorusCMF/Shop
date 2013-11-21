<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PjType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file',null,array('label' => 'Selectionnez un fichier'));
    }

    public function getName()
    {
        return '';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Pj',
            'csrf_protection' => false
        ));
    }
}