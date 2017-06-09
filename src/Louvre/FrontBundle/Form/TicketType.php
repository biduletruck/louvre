<?php

namespace Louvre\FrontBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visitorFullName', TextType::class, array(
                'label'=> 'Nom du visiteur',
                'attr' => array('class' => 'form-control')
            ))
            ->add('visitorCountry', CountryType::class, array(
                'label' => 'Pays visiteur',
                'attr' => array('class' => 'form-control')
            ))
            ->add('visitorBirthDate', BirthdayType::class, array(
                'label' => 'Date de naissance',
                'attr' => array(
                    'class' => 'form-control',
                    'type' => 'date'
                    )
            ))
            ->add('reducedPrices', CheckboxType::class, array(
                'required' => false,
                'label' => 'Avez-vous une réduction ?'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\FrontBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_frontbundle_tickets';
    }


}
