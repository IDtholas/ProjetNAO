<?php

namespace App\Form;

use App\Entity\Species;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VerifEditedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('observationDescription', TextType::class)
            ->add('species', EntityType::class, array (
                'class' => Species::class,
                'label' => 'Espèce d\'oiseau',
                'choice_label' => function ($species) {
                    if($species->getNomVernaculaire() !== '')
                    {
                        return $species->getNomVernaculaire();}
                    else{
                        return '--------------------';
                    }},
                'expanded' => false,
                'multiple' => false))
            ->add('proComment', TextType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
