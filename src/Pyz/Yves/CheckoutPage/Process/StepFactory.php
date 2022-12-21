<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Process;

use Pyz\Yves\CheckoutPage\CheckoutPageDependencyProvider;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderDetailsStep;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderDetailsStep\PostConditionChecker;
use Spryker\Yves\StepEngine\Dependency\Step\StepInterface;
use SprykerShop\Yves\CheckoutPage\Plugin\Router\CheckoutPageRouteProviderPlugin;
use SprykerShop\Yves\CheckoutPage\Process\StepFactory as SprykerStepFactory;
use SprykerShop\Yves\CheckoutPage\Process\Steps\PostConditionCheckerInterface;

class StepFactory extends SprykerStepFactory
{
    /**
     * @return array<\Spryker\Yves\StepEngine\Dependency\Step\StepInterface>
     */
    public function getSteps(): array
    {
        return [
            $this->createEntryStep(),
            $this->createCustomerStep(),
            $this->createOrderDetailsStep(),
            $this->createAddressStep(),
            $this->createShipmentStep(),
            $this->createPaymentStep(),
            $this->createSummaryStep(),
            $this->createPlaceOrderStep(),
            $this->createSuccessStep(),
            $this->createErrorStep(),
        ];
    }

    /**
     * @return \SprykerShop\Yves\CheckoutPage\Process\Steps\AddressStep
     */
    public function createOrderDetailsStep(): StepInterface
    {
        return new OrderDetailsStep(
            $this->createOrderDetailsStepPostConditionChecker(),
            CheckoutPageRouteProviderPlugin::ROUTE_NAME_CHECKOUT_ADDRESS,
            $this->getConfig()->getEscapeRoute(),
            $this->getCheckoutOrderDetailsStepEnterPreCheckPlugins(),
        );
    }

    /**
     * @return \SprykerShop\Yves\CheckoutPage\Process\Steps\PostConditionCheckerInterface
     */
    public function createOrderDetailsStepPostConditionChecker(): PostConditionCheckerInterface
    {
        return new PostConditionChecker();
    }

    /**
     * @return array<\SprykerShop\Yves\CheckoutPageExtension\Dependency\Plugin\CheckoutAddressStepEnterPreCheckPluginInterface>
     */
    public function getCheckoutOrderDetailsStepEnterPreCheckPlugins(): array
    {
        return $this->getProvidedDependency(CheckoutPageDependencyProvider::PLUGINS_CHECKOUT_ORDER_DETAILS_STEP_ENTER_PRE_CHECK);
    }
}
