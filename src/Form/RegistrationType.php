<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email')
            ->add('username')
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    private $confirm_password;
    public function getConfirmPassword()
    {
    return $this->confirm_password;
    }
    public function setConfirmPassword($confirm_password)
    {
    $this->confirm_password = $confirm_password;
    return $this;
    }

}
