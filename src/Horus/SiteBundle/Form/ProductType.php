<?php

namespace Horus\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('attr' => array( 'placeholder' => 'Ex:  Kindle Paperwhite')))
            ->add('accroche', 'text', array('attr' => array( 'placeholder' => "Ex:  Le meilleur appareil pour lecture, un point c'est tout")))
            ->add('video', 'text', array('required' => false, 'attr' => array( 'placeholder' => "Ex:  http://www.youtube.com/watch?v=BQjqM24uWr8")))
            ->add('reference', 'text', array('required' => true, 'attr' => array( 'placeholder' => 'Ex: EAX09-A')))
            ->add('ean', 'text', array('required' => false, 'attr' => array( 'placeholder' => 'Ex: 471-9-5120-0288-x')))
            ->add('quantity', 'integer', array('required' => true, 'required' => false, 'attr' => array('class' => 'form-control', 'placeholder' => 'Ex: 12')))
            ->add('etat', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array(1 => 'Neuf', 2 => 'Occasion', 3 => 'Reconditionné'),
                'required' => true,
                'expanded' => true
            ))
            ->add('tva', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array(1 => '19.6%', 2 => '20%', 3 => '7%', 4 => '10%', 5 => '5.5%', 6 => '2.1%'),
                'required' => true
            ))
            ->add('status', 'choice', array(
                'attr' => array('class' => 'rad'),
                'choices' => array(1 => 'Disponible à la vente', 2 => 'Juste afficher le prix', 3 => 'Gratuit'),
                'required' => true,
                'expanded' => true
            ))
            ->add('category',null, array('required' => true,'property' => 'optionLabel'))
            ->add('isShop')
            ->add('accesories')
            ->add('cates',null, array('property' => 'optionLabel'))
            ->add('articles')
            ->add('tags')
            ->add('familles')
            ->add('prodparent')
            ->add('metas', 'collection', array(
                'type' => new MetaType(),
                'by_reference' => true,
                'allow_delete' => true,
                'allow_add' => true
            ))
            ->add('seo', 'collection', array('type' => new SeoType()))
            ->add('prixHT', 'text', array('attr' => array( 'placeholder' => 'Ex: 15€')))
            ->add('prixTTC', 'text', array('attr' => array( 'placeholder' => 'Ex: 19€')))
            ->add('cover', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Résumé en quelques mots')))
            ->add('service', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'Ex: Garantie, Installation etc... ')))
            ->add('extras', 'textarea', array('required' => false, 'attr' => array('class' => 'form-control','cols' => 50, 'rows' => 6, 'placeholder' => 'Commentaire sur le produit')))
            ->add('tags')
            ->add('content', 'textarea', array('attr' => array("class" => "ckeditor", 'placeholder' => 'La description complè')))
            ->add('isVisible', null, array('required' => false))
            ->add('datePublication', 'date', array('widget' => 'single_text', 'attr' => array('class' => 'form-control','placeholder' => 'Format: AAAA-MM-JJ')));
    }

    public function getName()
    {
        return '';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Horus\SiteBundle\Entity\Produit',
            'csrf_protection' => false
        ));
    }
}
