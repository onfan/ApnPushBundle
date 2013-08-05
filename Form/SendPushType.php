<?php

/**
 * This file is part of the AppleApnPushBundle package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Apple\ApnPushBundle\Form;

use Apple\ApnPushBundle\ApnPush\ApnPush;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Send push form type
 */
class SendPushType extends AbstractType
{
    /**
     * @var ApnPush
     */
    protected $apnPush;

    /**
     * Construct
     *
     * @param ApnPush $apnPush
     */
    public function __construct(ApnPush $apnPush)
    {
        $this->apnPush = $apnPush;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $keys = array_keys($this->apnPush->all());
        $apnPushManagers = array_combine($keys, $keys);

        $builder
            ->add('manager', 'choice', array(
                'required' => true,
                'choices' => $apnPushManagers,
                'label' => 'form.manager',
                'translation_domain' => 'apple_apn_push'
            ))
            ->add('token', 'text', array(
                'required' => true,
                'max_length' => 64,
                'label' => 'form.device_token',
                'translation_domain' => 'apple_apn_push'
            ))
            ->add('body', 'text', array(
                'required' => true,
                'max_length' => 255,
                'label' => 'form.body_message',
                'translation_domain' => 'apple_apn_push'
            ))
            ->add('badge', 'number', array(
                'required' => false,
                'label' => 'form.badge',
                'translation_domain' => 'apple_apn_push',
                'attr' => array(
                    'min' => 0
                )
            ))
            ->add('sound', 'text', array(
                'required' => false,
                'label' => 'form.sound',
                'translation_domain' => 'apple_apn_push'
            ))
            ->add('custom_data', 'textarea', array(
                'required' => false,
                'label' => 'form.custom_data',
                'translation_domain' => 'apple_apn_push'
            ))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'apple_apn_push';
    }
}