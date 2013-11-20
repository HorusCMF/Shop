<?php

namespace Hetic\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ImageCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('title', 'text', array('required' => false,'attr' => array('placeholder' => 'Titre de la tâches')));
    }

    public function getName()
    {
        return '';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Hetic\SiteBundle\Entity\ImageCategory',
            'csrf_protection' => false
        ));
    }
}
