<?php

namespace App\Form;
use App\Entity\Subscription;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subscription', EntityType::class, [
                'class' => Subscription::class,
                'choice_label' => 'name', // Assure-toi que `name` existe bien dans Subscription
                'expanded' => true,  // Affiche sous forme de boutons radio
                'multiple' => false, // ⚠️ Doit être `false` car `subscription` est une seule entité
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider mon abonnement',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
