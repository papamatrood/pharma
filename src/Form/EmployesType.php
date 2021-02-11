<?php

namespace App\Form;

use App\Entity\Employes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EmployesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $civilites = [
            'Monsieur' => 'Monsieur', 
            'Madame' => 'Madame', 
            'Mademoiselle' => 'Mademoiselle'
        ];
        $situations = [
            'Marié(e)' => 'Marié(e)',
            'Célibataire' => 'Madame'
        ];
        $typeContrats = [
            'Stage' => 'Stage',
            'CDD' => 'CDD',
            'CDI' => 'CDI'
        ];
        $categories = [
            'Vaccataire' => 'Vaccataire',
            'Permanent' => 'Permanent'
        ];
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissanceAt', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance'
            ])
            ->add('lieuNaissance', null, [
                'label' => 'Lieu de naissance'
            ])
            ->add('adresse')
            ->add('nationalite')
            ->add('civilite', ChoiceType::class, [
                'choices' => $civilites,
                'multiple' => false,
                'label' =>'Civilité'
            ])
            ->add('dateEmbaucheAt', DateType::class, [
                'widget' => 'single_text',   
                'label' => 'Date d\'embauche'            
            ])
            ->add('fonction')
            ->add('telephone')
            ->add('email')
            ->add('categorie', ChoiceType::class, [
                'choices' => $categories,
                'label' => 'Catégorie'
            ])
            ->add('numeroAssuranceMaladie')
            ->add('typeContrat', ChoiceType::class, [
                'choices' => $typeContrats,
                'label' => 'Type de contrat'
            ])
            ->add('dateContratAt', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date du contrat'
            ])
            ->add('situationFamiliale', ChoiceType::class, [
                'choices' => $situations,
                'label' => 'Situation Familiale'
            ])
            ->add('nombreEnfant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employes::class,
        ]);
    }
}
