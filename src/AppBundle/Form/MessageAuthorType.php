<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('name', 'text', array(
                'label' => 'label.name',
            ))
            ->add('phone', 'text', array(
                'label' => 'label.phone',
            ))
            ->add('email', 'text', [
                'label' => 'label.author_email',
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