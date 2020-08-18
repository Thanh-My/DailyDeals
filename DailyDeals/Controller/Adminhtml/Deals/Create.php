<?php
namespace Tigren\DailyDeals\Controller\Adminhtml\Deals;

use Tigren\DailyDeals\Controller\Adminhtml\Deals;

class Create extends Deals
{
    /**
     * Create new news action
     *
     * @return void
     */
    public function execute()
    {
        // die(__METHOD__);
        $this->_forward('edit');
    }
}
