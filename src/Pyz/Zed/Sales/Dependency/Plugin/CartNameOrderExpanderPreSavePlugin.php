<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Sales\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Spryker\Zed\Sales\Dependency\Plugin\OrderExpanderPreSavePluginInterface;

class CartNameOrderExpanderPreSavePlugin implements OrderExpanderPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpySalesOrderEntityTransfer $salesOrderEntityTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SpySalesOrderEntityTransfer
     */
    public function expand(SpySalesOrderEntityTransfer $salesOrderEntityTransfer, QuoteTransfer $quoteTransfer): SpySalesOrderEntityTransfer
    {
        $salesOrderEntityTransfer->setPyzCartName($quoteTransfer->getPyzCartName());

        return $salesOrderEntityTransfer;
    }
}
