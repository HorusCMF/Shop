<?php

namespace Hetic\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('label' => "Titre de la caractéristique",'required' => false,'attr' => array( 'placeholder' => 'Titre de la tâches')))
                ->add('content', 'textarea', array('label' => "Contenu de la caractéristique",'required' => false,'attr' => array('class' => 'form-control','cols' => 100, 'rows' => 6,'placeholder' => 'Titre de la tâches')));
    }

    public function getName()
    {
        return 'meta';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Hetic\SiteBundle\Entity\Meta',
            'csrf_protection' => false
        ));
    }
}
