<?php

namespace App\Form;

use App\Entity\Familles;
use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formes = [
            'Sirop' => 'Sirop',
            'comprimé' => 'Sirop'
        ];
        $builder
            ->add('code')
            ->add('designation')
            ->add('prixUnitaire', null, [
                'label' => 'PU'
            ])
            ->add('datePeremptionAt', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Péremption',
            ])
            ->add('nomFabricant', null, [
                'label' => 'Fabricant'
            ])
            ->add('forme', ChoiceType::class, [
                'choices' => $formes,
                'label' => 'Forme'
            ])
            ->add('quantite')
            ->add('famille', EntityType::class, [
                'class' => Familles::class,
                'choice_label' => 'code',
                'label' => 'Code famille',
                'attr' => [
                    'class' => 'codeFamille'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
