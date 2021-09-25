<?php 
namespace Magepow\Promotionbar\Model;
use Magento\Framework\Data\OptionSourceInterface;
 
class SelectPage implements OptionSourceInterface
{
  
    
    public function getOptionArray()
    {
        $options = ['cms_index_index' => __('Home page'),
        'checkout_cart_index' => __('Shopping Cart Page'),
        'checkout_index_index'=>__('Checkout page')];
        return $options;
    }
 
   
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }
 
    /**
     * Get Grid row type array for option element.
     * @return array
     */
    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }
 
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}