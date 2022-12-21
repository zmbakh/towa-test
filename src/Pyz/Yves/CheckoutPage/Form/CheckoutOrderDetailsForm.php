<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Form;

use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageConfig getConfig()
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageFactory getFactory()
 */
class CheckoutOrderDetailsForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_PYZ_CART_NAME = 'pyzCartName';

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'orderDetailsForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addPyzCartNameField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addPyzCartNameField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_PYZ_CART_NAME, TextType::class, [
            'label' => 'Cart name',
            'required' => true,
            'constraints' => [
                new NotBlank(),
                new Length(['max' => 255]),
            ],
        ]);

        return $this;
    }
}
