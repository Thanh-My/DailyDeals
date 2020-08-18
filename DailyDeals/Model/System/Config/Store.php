<?php


namespace Tigren\DailyDeals\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;
use Magento\Store\Model\StoreManagerInterface;

class Store implements ArrayInterface
{
    protected $options;
//    protected $_respository;
    protected $_storeFactory;

    public function __construct(
        StoreManagerInterface $storeFactory
    )
    {
        $this->_storeFactory = $storeFactory;
    }



    public function toOptionArray()
    {
        $stores = $this->_storeFactory->getStores();

        $options = array();

        foreach ($stores as $key => $value) {
            $options = array_merge($options,[
//                'label' => $value['name'].' - '.$value['code'], 'value' => $key
                $value['name'] => __($value['name'])
            ]);
        }
        return $options;
    }

}
