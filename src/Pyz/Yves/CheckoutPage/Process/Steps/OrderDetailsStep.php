<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Process\Steps;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithBreadcrumbInterface;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithCodeInterface;
use SprykerShop\Yves\CheckoutPage\Process\Steps\AbstractBaseStep;
use SprykerShop\Yves\CheckoutPage\Process\Steps\PostConditionCheckerInterface;

class OrderDetailsStep extends AbstractBaseStep implements StepWithBreadcrumbInterface, StepWithCodeInterface
{
    /**
     * @var string
     */
    protected const STEP_CODE = 'address';

    protected PostConditionCheckerInterface $postConditionChecker;

    protected array $stepEnterPreCheckPlugins;

    /**
     * @param \SprykerShop\Yves\CheckoutPage\Process\Steps\PostConditionCheckerInterface $postConditionChecker
     * @param string $stepRoute
     * @param string|null $escapeRoute
     * @param array $stepEnterPreCheckPlugins
     */
    public function __construct(
        PostConditionCheckerInterface $postConditionChecker,
        string $stepRoute,
        ?string $escapeRoute,
        array $stepEnterPreCheckPlugins
    ) {
        parent::__construct($stepRoute, $escapeRoute);

        $this->postConditionChecker = $postConditionChecker;
        $this->stepEnterPreCheckPlugins = $stepEnterPreCheckPlugins;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return bool
     */
    public function requireInput(AbstractTransfer $quoteTransfer): bool
    {
        return $this->executeCheckoutAddressStepEnterPreCheckPlugins($quoteTransfer);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $quoteTransfer): bool
    {
        return $this->postConditionChecker->check($quoteTransfer);
    }

    /**
     * @return string
     */
    public function getBreadcrumbItemTitle(): string
    {
        return 'checkout.step.order_details.title';
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemEnabled(AbstractTransfer $quoteTransfer): bool
    {
        return $this->postCondition($quoteTransfer);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemHidden(AbstractTransfer $quoteTransfer): bool
    {
        return !$this->requireInput($quoteTransfer);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return static::STEP_CODE;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function executeCheckoutAddressStepEnterPreCheckPlugins(AbstractTransfer $quoteTransfer): bool
    {
        foreach ($this->stepEnterPreCheckPlugins as $stepEnterPreCheckPlugin) {
            if (!$stepEnterPreCheckPlugin->check($quoteTransfer)) {
                return false;
            }
        }

        return true;
    }
}
