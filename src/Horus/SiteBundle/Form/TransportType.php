<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class TransportType
 * @package Horus\SiteBundle\Form
 */
class TransportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', 'text', array('attr' => array('placeholder' => "Titre")))
                ->add('delay', 'text', array('attr' => array('placeholder' => "Délai")))
                ->add('ville', 'text', array('attr' => array('placeholder' => "Ville")))
                ->add('url', 'text', array('attr' => array('placeholder' => "Url")))
                ->add('from', 'text', array('attr' => array('placeholder' => "De")))
                ->add('to', 'text', array('attr' => array('placeholder' => "A")))
                ->add('prix', 'text', array('attr' => array('placeholder' => "A partir de")))
                ->add('service', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('quantity', 'text', array('attr' => array('placeholder' => "Quantité")))
                ->add('isVisible')
                ->add('status', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('point', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('etat', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('extras', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('livraison', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('tva', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('poid', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('longueur', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('largeur', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('hauteur', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('profondeur', 'text', array('attr' => array('placeholder' => "Service inclus")))
                ->add('departement', 'text', array('attr' => array('placeholder' => "Ville")))
                ->add('video', 'text', array('attr' => array('placeholder' => "Video")))
                ->add('delay', 'text', array('attr' => array('placeholder' => "Délai")))
                ->add('name', 'text', array('attr' => array('placeholder' => "Nom de la catégorie")))
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
            'data_class' => 'Horus\SiteBundle\Entity\Transport',
            'csrf_protection' => false
        ));
    }
}
