<?php
namespace Tigren\DailyDeals\Controller\Adminhtml\Deals;
use Tigren\DailyDeals\Controller\Adminhtml\Deals;

class Edit extends Deals
{
    public function execute()
    {
        $postId = $this->getRequest()->getParam('id');

        $model = $this->_dealsFactory->create();

        if ($postId) {
            $model->load($postId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists or price sale error '));
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_session->getNewsData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('tigren_daily_deals', $model);

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Tigren_DailyDeals::tigren');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Deals'));

        return $resultPage;
    }
}
