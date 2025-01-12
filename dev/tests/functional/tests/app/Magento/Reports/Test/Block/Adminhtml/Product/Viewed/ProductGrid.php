<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Reports\Test\Block\Adminhtml\Product\Viewed;

use Mtf\Client\Element\Locator;
use Magento\Backend\Test\Block\Widget\Grid;

/**
 * Class ProductGrid
 * Product Views Report
 */
class ProductGrid extends Grid
{
    /**
     * Product in grid locator
     *
     * @var string
     */
    protected $product = './/*[contains(.,"%s") and *[contains(@class,"price") and contains(.,"%d")]]';

    /**
     * Count product views
     *
     * @var string
     */
    protected $productView = '/*[contains(@class,"qty")]';

    /**
     * Get views Results from Products Report grid
     *
     * @param array $products
     * @param string $date
     * @return array
     */
    public function getViewsResults(array $products, $date = '')
    {
        $views = [];
        $date = date($date);
        if ($date) {
            $text = $this->_rootElement->getText();
            preg_match("`$date([^\n]*\n){1,5}`", $text, $match);
        }
        foreach ($products as $product) {
            if (isset($match[0]) && !strstr($match[0], $product->getName())) {
                continue;
            }
            $productLocator = sprintf($this->product . $this->productView, $product->getName(), $product->getPrice());
            $views[] = $this->_rootElement->find($productLocator, Locator::SELECTOR_XPATH)->getText();
        }
        return $views;
    }
}
