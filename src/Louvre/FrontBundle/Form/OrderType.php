<?php

namespace Louvre\FrontBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class OrderType extends AbstractType
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visitDate', DateType::class, array(
                    'required' => true,
                    'label' => 'Date de votre visite : ',
                    'widget' =>'single_text',
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
            ->add('tickets', CollectionType::class, array(
                'entry_type'   => TicketType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('save',      SubmitType::class,array(
                'label_format' => 'Réserver !',
                'attr' => array('class' => 'btn btn-success')
            ))
            ->setAction($this->router
                                    //->generate('louvre_front_saveorder'))
                                    ->generate('louvre_front_prepare_order'))
                                    ->setMethod(Request::METHOD_POST);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderModel::class
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
