<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\Sales;

use Spryker\Shared\Sales\SalesConfig as SprykerSalesConfig;

class SalesConfig extends SprykerSalesConfig
{
    /**
     * @var array<string>
     */
    protected const ORDER_SEARCH_TYPES = [
        'all',
        'orderReference',
        'itemName',
        'itemSku',
        'pyzCartName',
    ];
}
