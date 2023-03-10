<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\ProductRelation;

use Codeception\Actor;
use Codeception\Scenario;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class ProductRelationPresentationTester extends Actor
{
    use _generated\ProductRelationPresentationTesterActions;

    public const PRODUCT_TABLE_BODY_XPATH = '//*[@class="dataTables_scrollBody"]/table/tbody/tr[1]/td[1]';
    public const ELEMENT_TIMEOUT = 45;

    /**
     * @var int
     */
    protected $numberOfRulesSelected = 0;

    /**
     * @param \Codeception\Scenario $scenario
     */
    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);

        $this->amZed();
        $this->amLoggedInUser();
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function selectRelationType($type)
    {
        $this->selectOption('//*[@id="product_relation_productRelationType"]', $type);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function filterProductsByName($name)
    {
        $this->waitForElement(static::PRODUCT_TABLE_BODY_XPATH, static::ELEMENT_TIMEOUT);
        $this->fillField('//*[@id="product-table_filter"]/label/input', $name);

        return $this;
    }

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function selectProduct($sku)
    {
        $this->waitForElement(static::PRODUCT_TABLE_BODY_XPATH, static::ELEMENT_TIMEOUT);
        $buttonElementId = sprintf('//*[@id="select-product-%s"]', $sku);

        $this->waitForProcessingIsDone();
        $this->waitForElement($buttonElementId);

        $this->click($buttonElementId);

        return $this;
    }

    /**
     * @return $this
     */
    public function switchToAssignProductsTab()
    {
        $this->click('//*[@id="form-product-relation"]/div/ul/li[2]/a');

        return $this;
    }

    /**
     * @param string $ruleName
     * @param string $operator
     * @param string $value
     *
     * @return $this
     */
    public function selectProductRule($ruleName, $operator, $value)
    {
        $ruleSelectorBaseId = sprintf('[@id="builder_rule_%d"]', $this->numberOfRulesSelected);

        $this->selectOption(sprintf('//*%s/div[3]/select', $ruleSelectorBaseId), $ruleName);
        $this->selectOption(sprintf('//*%s/div[4]/select', $ruleSelectorBaseId), $operator);
        $this->fillField(sprintf('//*%s/div[5]/input', $ruleSelectorBaseId), $value);

        $this->numberOfRulesSelected++;

        return $this;
    }

    /**
     * @return $this
     */
    public function clickSaveButton()
    {
        $this->click('//*[@id="submit-relation"]');

        return $this;
    }

    /**
     * @return $this
     */
    public function waitForProcessingIsDone()
    {
        $this->waitForElementNotVisible('//*[@id="product-table_processing"]');
        $this->waitForElementNotVisible('//*[@id="rule-query-table_processing"]');

        return $this;
    }

    /**
     * @return $this
     */
    public function activateRelation()
    {
        $this->click('//*[@id="activate-relation"]');

        return $this;
    }
}
