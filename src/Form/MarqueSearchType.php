<?php

namespace App\Form;

use App\Entity\MarqueSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Marque;

class MarqueSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
 {
 $builder
 ->add('marque',EntityType::class,['class' => Marque::class,
 'choice_label' => 'titre' ,
 'label' => 'Marque' ]);

 }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MarqueSearch::class,
        ]);
    }
}
