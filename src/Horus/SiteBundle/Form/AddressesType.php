<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AddressesType
 * @package Horus\SiteBundle\Form
 */
class AddressesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nature','choice', array(
                    'choices'   => array(1 => 'Livraison/Facturation', 2 => 'Livraison', 3 => 'Facturation'),
                    'required'  => true,
                    'expanded' => false
                ))
                ->add('adresse', 'text', array('attr' => array('placeholder' => "128 Avenue Leclerc")))
                ->add('adresse2', 'text', array('required' => false,'attr' => array('placeholder' => "Lieu dit, passage ...")))
                ->add('zipcode', 'text', array( 'label' => 'Code Postal', 'attr' => array('placeholder' => 'Ex: 75001')))
                ->add('ville', 'text', array('attr' => array('placeholder' => "Lyon")))
                ->add('etage', 'text', array('required' => false,'attr' => array('placeholder' => "2eme")))
                ->add('numero', 'text', array('required' => false,'attr' => array('placeholder' => "17")))
                ->add('interphone', 'text', array('required' => false,'attr' => array('placeholder' => "5813A")));

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
            'data_class' => 'Horus\SiteBundle\Entity\Addresses',
            'csrf_protection' => false
        ));
    }
}
