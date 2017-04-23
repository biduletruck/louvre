<?php

namespace Louvre\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visitDate', TextType::class, array(
                    'label' => 'Date de votre visite : ',
                    'attr' => array('class' => 'form-control datepicker',
                                    'readonly' => 'readonly'))
            )
            ->add('ticketType', ChoiceType::class, array(
                'label' => 'Type de billet : ',
                'choices' => array(
                    'Billet journée' => '1',
                    'Billet demi journée' => '2'),
                'attr' => array('class' => 'form-control')
            ))
            ->add('buyerLastName', TextType::class, array(
                'label' => 'Votre prénom : ',
                'attr' => array('class' => 'form-control')
            ))
            ->add('buyerFirstName', TextType::class, array(
                'label' => 'Votre Nom : ',
                'attr' => array('class' => 'form-control')
            ))
            ->add('buyerEmail', EmailType::class, array(
                'label' => 'Votre Email : ',
                'attr' => array('class' => 'form-control')
            ))


            ->add('save',      SubmitType::class,array(
                'attr' => array('class' => 'btn btn-primary')));
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\FrontBundle\Entity\Orders'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_frontbundle_orders';
    }


}
