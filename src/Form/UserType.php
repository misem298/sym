<?php

namespace App\Form;

use App\Controller\Admin;
use App\Controller\Admin\AdminUserController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Grupe;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\FormEvents;
use Symfony\Component\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\ProductRepository;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

class UserType extends AbstractType

{

    public function buildForm(FormBuilderInterface $builder, array $options )
    {

        $builder
            ->add('email', EmailType::class, array(
                'label' => 'input email: ',
            ))
            ->add('grupe', EntityType::class, [
                'label' => 'select grupe: ',
                'class' => 'App\Entity\Grupe',
                'placeholder' => 'select group',
          //      'mapped' => false,
                ])
            ->add('roles', ChoiceType::class, array(
                    'attr'  =>  array('class' => 'form-control',
                        'style' => 'margin:15px; width:200px; height: 100px;'),
                    'label' => 'select role: ',
                    'choices' =>
                        array
                        (
                            'ROLE_ADMIN' => array
                            (
                                'Yes' => 'ROLE_ADMIN',
                            ),
                            'ROLE_USER' => array
                            (
                                'Yes' => 'ROLE_USER'
                            ),
                        ),
                    'multiple' => true,
                    'required' => true,
                )
            )
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array(
                    'label' => 'password: ',
                ),
                    'second_options' => array(
                        'label' => 'repeat password: ',
                )
            ))
            -> add ('save', SubmitType::class, array(
            'label' => 'save ',
                'attr'  =>  array('class' => 'form-control but_buy textr  ',
                    'style' => 'margin:15px; width:200px; height: 100px;'),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }



}
