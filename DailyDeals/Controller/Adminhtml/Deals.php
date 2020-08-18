<?php

namespace Tigren\DailyDeals\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Tigren\DailyDeals\Model\DealsFactory;

class Deals extends Action
{
    protected $_coreRegistry;
    protected $_resultPageFactory;
    protected $_dealsFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        DealsFactory $dealsFactory
    )
    {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_dealsFactory = $dealsFactory;

    }

    public function execute()
    {

    }

    protected function _isAllowed()
    {
        return true;
    }
}
