<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('type',ChoiceType::class, [
                'choices'  => [
                    'Article sur le livre' => 'Article sur le livre',
                    'Article sur l\'auteur ' => 'Article sur l\'auteur ',
                    'Analyse personnelle' => 'Analyse personnelle',
                    'Bibliographie de l\'auteur' => 'Bibliographie de l\'auteur',
                    'Travaux scolaires' => 'Travaux scolaires',
                    'livre'=>'livre',
                    'Thèse'=>'Thèse',
                ],
            ])
            ->add('auteurNom')
            ->add('auteurPrenom')
            ->add('fichier',FileType::class, array(
                'label' => 'Charger votre document'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
