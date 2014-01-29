<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientsAdressesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('addresses', 'collection', array(
                'type' => new AddressesType(),
                'by_reference' => true,
                'allow_delete' => true,
                'allow_add' => true
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Client',
            'csrf_protection' => false

        ));
    }

    public function getName()
    {
        return '';
    }
}
