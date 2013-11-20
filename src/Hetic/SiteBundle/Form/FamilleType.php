<?php

namespace Hetic\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FamilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', 'text', array('attr' => array('placeholder' => 'Titre de la tâches')))
                ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
                ->add('description', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('parent')
                ->add('produits');
    }

    public function getName()
    {
        return '';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Hetic\SiteBundle\Entity\Famille',
            'csrf_protection' => false
        ));
    }
}
