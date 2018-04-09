<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Species;

class ObservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('picture', FileType::class)
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
