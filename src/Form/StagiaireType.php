<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TexteType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom',TexteType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Ville',TexteType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('numTel',TexteType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sexe',TexteType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dateNaissance',DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email',TexteType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sessions',EntityType::class, [
                'class' => Session::class,
                'attr' =>[
                    'class' => 'form-control'
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr'=>[
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
