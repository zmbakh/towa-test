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
use Symfony\Component\Validator\Constraints\Regex;

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
    public function getBlockPrefix(): string
    {
        return 'orderDetailsForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
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
            'label' => 'checkout.step.order_details.cart_name',
            'required' => true,
            'constraints' => [
                new NotBlank(),
                new Length(['max' => 255]),
                new Regex('/^[a-z0-9]+$/', 'checkout.validation.order_details.digits_and_lower_case_letters'),
            ],
        ]);

        return $this;
    }
}
