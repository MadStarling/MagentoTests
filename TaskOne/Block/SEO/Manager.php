<?php
declare(strict_types=1);

namespace Starling\TaskOne\Block\SEO;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Cms\Model\Page;

class Manager extends Template
{
    protected $_storeManager;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Page $cmsPage,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_cmsPage = $cmsPage;
        parent::__construct($context, $data);
    }

    /*
     * @return string
     */
    public function preventDuplicatedSEO()
    {
        $store = $this->_storeManager->getStore();
        $baseUrl = $store->getBaseUrl();
        $storeLanguage = $store->getLocale();
        $pageId = $this->_cmsPage->getIdentifier();

        return '<link rel="alternate" hreflang="'. $storeLanguage . '" href="' . $baseUrl . $pageId . '">';
    }
}