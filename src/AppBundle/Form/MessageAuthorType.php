<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class MessageAuthorType
 * @package AppBundle\Form
 */
class MessageAuthorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'label.author_name',
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3))
                ),
            ))
            ->add('phone', TextType::class, array(
                'label' => 'label.author_phone',
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 9))
                )
            ))
            ->add('email', TextType::class, [
                'label' => 'label.author_email',
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)),
                    new Email()
                )
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Model\MessageAuthor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'message_author';
    }
}