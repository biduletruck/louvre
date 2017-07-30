<?php

namespace Louvre\FrontBundle\Form;

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
            ->add('firstname', TextType::class, array(
                'label' => 'Prenom',
                'label_attr' => array(
                    'class' => 'col-lg-3 control-label',
                ),
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
                'label_attr' => array(
                    'class' => 'col-lg-3 control-label',
                ),
            ))
            ->add('email', EmailType::class, array(
                'label' => 'email',
                'label_attr' => array(
                    'class' => 'col-lg-3 control-label',
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Terminer la commande',
                'attr' => array(
                    'class' => 'btn btn-success btn-block',
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Command',
            'validation_groups' => array('payment'),
        ));
    }

    public function getBlockPrefix()
    {
        return 'form_payment';
    }
}
