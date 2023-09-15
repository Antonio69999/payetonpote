<?php

namespace App\Form;

use App\Entity\Campaign;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' =>'Titre de votre campagne : ',
            ])
            ->add('content', TextType::class, [
                'label' => 'Pourquoi ?',
                'attr' => [
                    'placeholder' => 'Contenu de votre campagne : ',
                    'class' => 'text-area',
                ],
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('goal', IntegerType::class, [
                'label' =>'Votre objectif en euros : ',
            ])
            ->add('name', TextType::class, [
                'label' =>'Votre Nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
