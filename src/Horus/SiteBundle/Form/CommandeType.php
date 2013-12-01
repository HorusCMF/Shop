<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CommandeType
 * @package Horus\SiteBundle\Form
 */
class CommandeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('content', 'text', array('attr' => array('placeholder' => "Le contenu en message")))
                ->add('message', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Votre petit message')))
                ->add('transport')
                ->add('totalTTC')
                ->add('totalHT')
                ->add('etat','choice', array(
                        'choices'   => array(
                            1 => 'Annulé',
                            2 => 'En attente de réaprovisionement',
                            3 => 'En attente de virrement',
                            4 => 'En cours de livraison',
                            5 => 'Erreur de paiement',
                            6 => 'Livré',
                            7 => 'Paiement accepté',
                            8 => 'Préparation en cours'
                        ),
                    'required'  => true,
                ))
        ;
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
            'data_class' => 'Horus\SiteBundle\Entity\Commandes',
            'csrf_protection' => false
        ));
    }
}
