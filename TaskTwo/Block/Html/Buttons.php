<?php
/**
 * A Magento 2 module named Starling/TaskTwo
 * Copyright (C) 2019 
 * 
 * This file included in Starling/TaskTwo is licensed under OSL 3.0
 * 
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Starling\TaskTwo\Block\Html;

class Buttons extends \Magento\Framework\View\Element\Template
{
    private $scopeConfig;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getButtonsColor()
    {
        return $this->_scopeConfig->getValue('tasktwo/general/color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
