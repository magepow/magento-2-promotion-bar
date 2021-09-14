<?php

namespace Magepow\Promotionbar\Block\Product;


class Promotionbar extends \Magento\Catalog\Block\Product\AbstractProduct
{
  /**
     * Product collection factory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_ruleFactory;

    
    protected $_promotionbarFactory;

    protected $_limit; // Limit Product

    protected $_parameters; // Condition Product
    protected $_request;
    protected $_abstractProduct;
    protected $json;
    protected $_filter;
    protected $_registry;
    protected $_timezone;
    protected $_customerSession;
    protected $_conditions;
    protected $_helper;
    protected $validate;
    protected $_json;

    /**
     * @param Context $context
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\CatalogWidget\Model\RuleFactory $ruleFactory,
        \Magepow\Promotionbar\Model\PromotionbarFactory $promotionbarFactory,
        \Magento\Cms\Model\Template\FilterProvider $filter,
         \Magento\Framework\Registry $registry,
         \Magento\Customer\Model\Session $customerSession,
          \Magento\Store\Model\StoreManagerInterface $storeManager,
           \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
          \ Magento\Rule\Model\Condition\Combine $validate,
           \Magepow\Promotionbar\Helper\Data $helper,
             \Magepow\Promotionbar\Serialize\Serializer\Json $json,

        array $data = []
    ) {
        $this->_ruleFactory = $ruleFactory;
        $this->_filter = $filter;
        $this->_customerSession = $customerSession;
        $this->_promotionbarFactory = $promotionbarFactory;
     	  $this->_registry = $registry;
     	  $this->_timezone = $timezone;
          $this->validate = $validate;
          $this->_json= $json;
     	
        $this->_storeManager = $storeManager;
        $this->_helper = $helper;
        parent::__construct($context, $data);
        
    }

    public function getPromotionbarCollection()
    {

		$date = $this->_timezone->date()->format('Y-m-d H:i:s');
        $store = $this->_storeManager->getStore()->getStoreId();
       // print_r($store);
        $customerGroup = $this->getCustomerGroup();
        $position = array('header.container', 'content.top', 'content.bottom','page.bottom.container');
        $collection = $this->_promotionbarFactory->create()->getCollection()
                        ->addFieldToSelect('*')
                        ->addFieldToFilter('is_active', 1)
                        ->addFieldToFilter('stores', array(array('finset' => 0), array('finset' => $store)))
                        ->addFieldToFilter('start_at', array('lteq' => $date))
                        ->addFieldToFilter('end_at', array('gteq' => $date))
                        ->addFieldToFilter('customer_group',array(array('finset'=>0), array('finset'=>$customerGroup)))
                        ->setOrder('sort_order','DESC');
                        
                       

        return $collection;
    }
 

    public function getPromotionbarProduct()
    {
        if(!$this->hasData('promotionbar')) {

             $collection = $this->getPromotionbarCollection();
            $product    = $this->getProduct();       
      
            $promotionbar  = '';
           
            foreach ($collection as $item) {
                $config = $item->getConditionsSerialized();
                $display = $item->getDisplayPage();
                $data = $this->_json->unserialize($config);
                $parameters =  $data['parameters'];
               
                $rule = $this->getRule($parameters);

                 $validate = $rule->getConditions()->validate($product);
                 if($validate){
                  
                    $promotionbar = $item;
                    break;
                }                               
            
          }

           return $promotionbar;
        }

        return $this->getData('promotionbar');
    }
     public function getPromotionbarCategory()
    {
        if(!$this->hasData('promotionbar')) {

            $collection = $this->getPromotionbarCollection();
            $categorySelection    = $this->getCurrentCategory();    
            $promotionbar  = '';
           
            foreach ($collection as $item) {
                $categoryId = $item->getCategory();             
                
			if($categoryId && in_array($categoryId, explode(",", $categorySelection))){
                 
                    $promotionbar = $item;
                    break;
                }
                                      
          }
         
          return $promotionbar;
        }

        return $this->getData('promotionbar');
    }

    public function getContentFromStaticBlock($content)
    {
        return $this->_filter->getBlockFilter()->filter($content);
    }
    protected function getCustomerGroup()
    {
        $customerGroup = NULL;
        if($this->_customerSession->isLoggedIn()){
            $customerGroup = $this->customerSession->getCustomer()->getGroupId();
        }

        return $customerGroup;
    }

    public function getCurrentCategory(){
    	 return $this->_registry->registry('current_category')->getId();
    }
   
    protected function getRule($conditions)
    {
        $rule = $this->_ruleFactory->create();
        if (is_array($conditions)) $rule->loadPost($conditions);
        return $rule;
    }

    public function getDataSliderControl(){
      $getDataSliderControl = $this->_helper->getConfigModule('magepow_promotionbar/general/showslider');
      if($getDataSliderControl == 1){
        return "true";
      }else{
        return "false";
      }
    }
   
    
}