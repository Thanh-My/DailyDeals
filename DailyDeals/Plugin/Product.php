<?php

namespace Tigren\DailyDeals\Plugin;

use Magento\Framework\View\Element\Template;
use Tigren\DailyDeals\Model\ResourceModel\Deals\CollectionFactory as DealCollection;
use \Magento\Catalog\Model\ProductRepository;

class Product extends Template
{   
    protected $DealCollection;
    protected $registry;
    protected $collectionItem;

    public function __construct(
        Template\Context $context,
        DealCollection $DealCollection,
        \Magento\Framework\Registry $registry,
        ProductRepository $collection
    )
    {
        $this->DealCollection = $DealCollection;
        $this->registry = $registry;
        $this->collection = $collection;
        parent::__construct($context);
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {   
        
        $deal = $this->DealCollection->create();
        $dealSku = [];
        foreach ($deal as $dealItem) {
            $dealSku[] = $dealItem->GetData('product_sku');
        }

        $id = $subject->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $parentId = $objectManager->create('Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable')->getParentIdsByChild($id);

        if (isset($parentId[0])) {
            $productSku = $this->collection->getById($parentId[0])->getSku();
        } else {
            $productSku = $subject->getSku();
        }
//        var_dump($productQty); exit;
        if (in_array($productSku, $dealSku)) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $endTime = $deal->getItemByColumnValue('product_sku', $productSku)->getData('end_time');
            $startTime = $deal->getItemByColumnValue('product_sku', $productSku)->getData('start_time');
            $now = date('Y-m-d H:i:s');
            $status = $deal->getItemByColumnValue('product_sku', $productSku)->getData('status');
//            var_dump($now <= $endTime);
            $result1 = $deal->getItemByColumnValue('product_sku', $productSku)->getData('deal_percentsale');
            // echo $result;
            if ($now <= $endTime && $status == 1 && $now >= $startTime) {
                // $result1 = $deal->getItemByColumnValue('product_sku', $productSku)->getData('deal_price');
                //giá sau khi giảm
                $result = $result-(($result/100)*$result1);
                //giá gốc
                $result2 = ($result*100)/(100-$result1);
                // $result = '<h1>'. $result .'hello'.'</h1>'.
                // '<br>'.'<strike>'.$result2.'</strike>';
                // $result = ['<h1>'. $result .'eello'.'</h1>'];
                // echo'<h1>'.$result2.'</h1>';
                
                return $result;
            } else {
                return $result;
            }
            }
        else {
            return $result;
    }
}
}
