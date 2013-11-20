<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('attr' => array('placeholder' => 'Titre de la tâches')))
                ->add('category')
                ->add('tags')
                ->add('pages')
                ->add('nature','choice', array(
                    'choices'   => array(1 => 'Brouillon', 2 => 'Relus', 3 => 'Final'),
                    'required'  => true,
                    'expanded' => true
                ))
                ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'RÉsumé en quelques mots')))
                ->add('content', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Description complète')))
                ->add('isVisible', null, array('required' => false))
                ->add('datePublication', 'date', array('widget' => 'single_text'));
    }

    public function getName()
    {
        return '';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver){

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Article',
            'csrf_protection' => false
        ));
    }
}
