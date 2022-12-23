<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\Sales\Dependency\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderEntityTransfer;
use Pyz\Zed\Sales\Dependency\Plugin\CartNameOrderExpanderPreSavePlugin;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group Sales
 * @group Dependency
 * @group Plugin
 * @group CartNameOrderExpanderPreSavePluginTest
 * Add your own group annotations below this line
 */
class CartNameOrderExpanderPreSavePluginTest extends Unit
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->cartNameOrderExpanderPreSavePlugin = new CartNameOrderExpanderPreSavePlugin();
    }

    /**
     * @dataProvider cartNameOrderExpanderPreSavePluginDataProvider
     *
     * @param string|null $value
     *
     * @return void
     */
    public function testCartNameOrderExpanderPreSavePlugin(?string $value): void
    {
        $spySalesOrderEntityTransfer = $this->cartNameOrderExpanderPreSavePlugin->expand(
            $this->createSpySalesOrderEntityTransfer(),
            $this->createQuoteTransfer($value)
        );

        $this->assertEquals($value, $spySalesOrderEntityTransfer->getPyzCartName());
    }

    /**
     * @return array[]
     */
    public function cartNameOrderExpanderPreSavePluginDataProvider(): array
    {
        return [
            'should return null value' => [
                null,
            ],
            'should return empty string' => [
                '',
            ],
            'should return a string' => [
                'asdfbvcx452',
            ],
            'should return another string' => [
                '55432tgdfsg sdfg sdf6543',
            ],
        ];
    }

    /**
     * @return \Generated\Shared\Transfer\SpySalesOrderEntityTransfer
     */
    protected function createSpySalesOrderEntityTransfer(): SpySalesOrderEntityTransfer
    {
        return new SpySalesOrderEntityTransfer();
    }

    /**
     * @param string $value
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createQuoteTransfer(string $value): QuoteTransfer
    {
        return (new QuoteTransfer())->setPyzCartName($value);
    }
}
