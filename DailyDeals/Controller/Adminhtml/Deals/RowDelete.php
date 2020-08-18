<?php
namespace Tigren\DailyDeals\Controller\Adminhtml\Deals;

use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Tigren\DailyDeals\Model\Deals;
use Tigren\DailyDeals\Model\DealsFactory;
use Tigren\DailyDeals\Model\ResourceModel\Deals\CollectionFactory;

class RowDelete extends Action
{
    protected $_pageFactory;
    protected $_dealsFactory;
    protected $_filter;
    protected $_collectionFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Filter $filter,
        DealsFactory $dealsFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_dealsFactory = $dealsFactory;
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {

                $model = $this->_objectManager->create(Deals::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The deals was deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {

                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a news to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
