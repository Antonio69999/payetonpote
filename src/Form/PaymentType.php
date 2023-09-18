<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', IntegerType::class, [
                'row_attr' => [
                    'class' => 'input-field col s6',
                ],
                'label' => 'Montant du paiement',
                'attr' => [
                    'class' => 'validate',
                    'id' => 'amount',
                ],
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('participantId', ParticipantType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
