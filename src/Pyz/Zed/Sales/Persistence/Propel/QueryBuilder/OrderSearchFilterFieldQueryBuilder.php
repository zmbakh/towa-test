<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Sales\Persistence\Propel\QueryBuilder;

use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Spryker\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder as SprykerOrderSearchFilterFieldQueryBuilder;

class OrderSearchFilterFieldQueryBuilder extends SprykerOrderSearchFilterFieldQueryBuilder
{
    /**
     * @var array<string, string>
     */
    protected const ORDER_BY_COLUMN_MAPPING = [
        self::SEARCH_TYPE_ORDER_REFERENCE => SpySalesOrderTableMap::COL_ID_SALES_ORDER,
        'date' => SpySalesOrderTableMap::COL_CREATED_AT,
        'pyzCartName' => SpySalesOrderTableMap::COL_PYZ_CART_NAME,
    ];
}
