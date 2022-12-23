<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CheckoutPage\Process\Steps\OrderDetailsStep;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\CheckoutPage\Process\Steps\OrderDetailsStep\PostConditionChecker;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group CheckoutPage
 * @group Process
 * @group Steps
 * @group OrderDetailsStep
 * @group PostConditionCheckerTest
 * Add your own group annotations below this line
 */
class PostConditionCheckerTest extends Unit
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->postConditionChecker = new PostConditionChecker();
    }

    /**
     * @dataProvider postConditionCheckerDataProvider
     *
     * @param string|null $value
     * @param bool $expected
     *
     * @return void
     */
    public function testPostConditionChecker(?string $value, bool $expected)
    {
        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->setPyzCartName($value);

        $result = $this->postConditionChecker->check($quoteTransfer);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array[]
     */
    public function postConditionCheckerDataProvider(): array
    {
        return [
            'should return false when the cart name is null' => [
                null,
                false,
            ],
            'should return true when the cart name is empty string' => [
                '',
                true,
            ],
            'should return true when the cart name is string' => [
                'asdfbvcx452',
                true,
            ],
        ];
    }
}
