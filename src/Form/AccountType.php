<?php

namespace App\Form;

use App\Entity\Account;
use App\Entity\Country;
use App\Entity\Job;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('birthday', DateType::class, [
                'label' => 'Data de naissance'
            ])
            ->add('email', EmailType::class)
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => "0",
                    'Femme' => "1",
                ],
                'expanded' => true,
            ])
            ->add('pays', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'libele',
            ])
            ->add('metier', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'libele',
                'label' => 'Métier'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
