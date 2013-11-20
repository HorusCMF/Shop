<?php

namespace Hetic\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('required' => false,'attr' => array('placeholder' => 'Titre de la tâches')))
                ->add('keywords', 'textarea', array('required' => false,'attr' => array('cols' => 100, 'rows' => 6, 'placeholder' => 'Titre de la tâches')))
                ->add('description', 'textarea', array('required' => false,'attr' => array('cols' => 100, 'rows' => 6,'placeholder' => 'Titre de la tâches')));
    }

    public function getName()
    {
        return 'referencement';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Hetic\SiteBundle\Entity\Seo',
            'csrf_protection' => false
        ));
    }
}
