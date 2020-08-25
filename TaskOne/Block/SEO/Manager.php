<?php
declare(strict_types=1);

namespace Starling\TaskOne\Block\SEO;

class Manager extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function preventDuplicatedSEO()
    {
        $store = $this->_storeManager->getStore();
        $baseUrl = $store->getBaseUrl();
        $storeLanguage = $store->getLocale();
        $pageId = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Cms\Model\Page')->getIdentifier();

        $tag = '<link rel="alternate" hreflang="'. $storeLanguage . '" href="' . $baseUrl . $pageId . '">';
        return $tag;
    }
}