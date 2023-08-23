<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Ville',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('numTel',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sexe',TextType::class,[
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
            ->add('email',TextType::class,[
                'attr' => [
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
