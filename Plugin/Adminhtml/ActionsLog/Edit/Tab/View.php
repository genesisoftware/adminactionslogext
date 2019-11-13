<?php

namespace Jn2\AdminActionsLogExt\Plugin\Adminhtml\ActionsLog\Edit\Tab;

use Amasty\AdminActionsLog\Block\Adminhtml\ActionsLog\Edit\Tab\View as ViewPlugin;
use Amasty\AdminActionsLog\Model\Log;
use DateTime;

class View
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * View constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetLog(ViewPlugin $subject, Log $log)
    {
        $timezone = $this->scopeConfig->getValue('general/locale/timezone');

        $date = new DateTime($log->getDateTime());
        $date->setTimezone(new \DateTimeZone($timezone));
        $log->setData('date_time', $date->format('Y-m-d H:i:s'));
        return $log;
    }
}