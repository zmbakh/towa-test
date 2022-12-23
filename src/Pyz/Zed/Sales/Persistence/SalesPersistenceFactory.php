<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Sales\Persistence;

use Pyz\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilder;
use Spryker\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilderInterface;
use Spryker\Zed\Sales\Persistence\SalesPersistenceFactory as SprykerSalesPersistenceFactory;

class SalesPersistenceFactory extends SprykerSalesPersistenceFactory
{
    /**
     * @return \Spryker\Zed\Sales\Persistence\Propel\QueryBuilder\OrderSearchFilterFieldQueryBuilderInterface
     */
    public function createOrderSearchFilterFieldQueryBuilder(): OrderSearchFilterFieldQueryBuilderInterface
    {
        return new OrderSearchFilterFieldQueryBuilder();
    }
}
