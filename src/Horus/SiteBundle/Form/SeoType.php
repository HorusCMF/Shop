<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('required' => false,'attr' => array('placeholder' => 'Titre')))
                ->add('keywords', 'textarea', array('required' => false,'attr' => array('cols' => 100, 'rows' => 6, 'placeholder' => 'Mot-Clefs')))
                ->add('description', 'textarea', array('required' => false,'attr' => array('cols' => 100, 'rows' => 6,'placeholder' => 'Description')));
    }

    public function getName()
    {
        return 'referencement';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Seo',
            'csrf_protection' => false
        ));
    }
}
