<?php 
namespace Magepow\Promotionbar\Model;
use Magento\Framework\Data\OptionSourceInterface;
 
class DisplayPage implements OptionSourceInterface
{
    
    
    public function getOptionArray()
    {
        $options = ['1' => __('Specific Page(s)'),'0' => __('All Pages')];
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