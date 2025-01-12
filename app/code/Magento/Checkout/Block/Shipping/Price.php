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
namespace Magento\Checkout\Block\Shipping;

use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Sales\Model\Quote\Address\Rate;
use Magento\Checkout\Block\Cart\AbstractCart;

class Price extends AbstractCart
{
    /**
     * @var Rate
     */
    protected $shippingRate;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Helper\Data $catalogData
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Helper\Data $catalogData,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        PriceCurrencyInterface $priceCurrency,
        array $data = array()
    ) {
        $this->priceCurrency = $priceCurrency;
        parent::__construct($context, $catalogData, $customerSession, $checkoutSession, $data);
    }


    /**
     * Set the shipping rate
     *
     * @param Rate $shippingRate
     * @return $this
     */
    public function setShippingRate(Rate $shippingRate)
    {
        $this->shippingRate = $shippingRate;
        return $this;
    }

    /**
     * Return shipping rate
     *
     * @return Rate
     */
    public function getShippingRate()
    {
        return $this->shippingRate;
    }

    /**
     * Get Shipping Price
     *
     * @return float
     */
    public function getShippingPrice()
    {
        return $this->priceCurrency->convertAndFormat($this->shippingRate->getPrice());
    }
}
