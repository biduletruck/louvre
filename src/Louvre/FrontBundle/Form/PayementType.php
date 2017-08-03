<?php

namespace Louvre\FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PayementType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalAmount', IntegerType::class, array(
                'label' => 'Total',
                'label_attr' => array(
                    'class' => 'col-lg-3 control-label',
                ),
            ))
            ->add('numberCommand',TextType::class, array(
                'label' => 'Numero de commande',
                'label_attr' => array(
                    'class' => 'col-lg-3 control-label',
                )
            ))
            ->add('order', OrderType::class)
            ->add('submit', SubmitType::class, array(
                'label' => 'Terminer la commande',
                'attr' => array(
                    'class' => 'btn btn-success btn-block',
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults( array('Louvre\FrontBundle\Entity\OrderFactory'));
    }

    public function getBlockPrefix()
    {
        return 'form_payment';
    }
}
