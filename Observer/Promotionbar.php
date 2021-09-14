<?php

namespace Magepow\Promotionbar\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magepow\Promotionbar\Model\Position;
use Magepow\Promotionbar\Model\SelectPage;
use Magento\Widget\Model\Layout\UpdateFactory;


class Promotionbar implements ObserverInterface
{
    protected $_scopeConfig;
 
  protected $request;
  protected $_promotionbar;
  protected $_ruleFactory;
  protected $_registry;
  protected $_helper;
  const BLOCK = 'Magepow\Promotionbar\Block\Product\Promotionbar';
   const TEMPLATE_TOPCONTENT     = 'Magepow_Promotionbar::promotionbar_topcontent.phtml';
   const TEMPLATE_TOPMENU ='Magepow_Promotionbar::promotionbar_topmenu.phtml';
   
   const TEMPLATE_BOTTOMPAGE ='Magepow_Promotionbar::promotionbar_bottompage.phtml' ;
   
  public function __construct(
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
      \Magento\Framework\App\Request\Http $request,
      \Magepow\Promotionbar\Block\Product\Promotionbar $promotionbar,
      \Magento\CatalogWidget\Model\RuleFactory $ruleFactory,
      \Magepow\Promotionbar\Helper\Data $helper,

       \Magento\Framework\Registry $registry
     
  ) {

    $this->_scopeConfig = $scopeConfig;
    $this->request = $request;
    $this->_promotionbar = $promotionbar;
    $this->_registry = $registry;
    $this->_helper = $helper;
   
  }

 public function execute(Observer $observer)
 {
    /** @var LayoutInterface $layout */
   
  if(!$this->_helper->getConfigModule('general/enabled')) return;
   $layout = $observer->getEvent()->getLayout();
         $actionName = $this->request->getFullActionName();  
          $page = $this->getDisplayPage();
          $promotionbarCollection = $this->_promotionbar->getPromotionbarCollection();
          foreach ($promotionbarCollection as  $value) {

       $position = $value->getPosition(); 
       $displayPage = $value->getData('display_onpage');
       $page = $this->getDisplayPage();
     
       $displayOnProductPage = $value->getData('is_shown_on_productpage');
       if($displayOnProductPage == 1) {

        if ($actionName == "catalog_product_view") {
       
     
           if($position == 1){
           $xml = '<referenceContainer name="content.top">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPCONTENT . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
      $layout->generateXml();

        }
        if ($position == 2) {
         $xml = '<referenceContainer name="header.container">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPMENU . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
      $layout->generateXml();
        }
        if($position == 3){
         $xml = '<referenceContainer name="page.bottom.container">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_BOTTOMPAGE . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
      $layout->generateXml();
      }
         }
      
      }
         if ($actionName == "catalog_category_view") {
       
            if($position == 1){
           $xml = '<referenceContainer name="content.top">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPCONTENT . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
          $layout->generateXml();

        }if ($position == 2) {
         $xml = '<referenceContainer name="header.container">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPMENU . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
          $layout->generateXml();

        }
        if($position == 3){
         $xml = '<referenceContainer name="page.bottom.container">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_BOTTOMPAGE . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
      $layout->generateXml();
      }
         
        }     
      
  if($actionName == 'cms_index_index' && in_array($actionName, $page)||$actionName == 'checkout_index_index' && in_array($actionName, $page)||$actionName == 'checkout_cart_index' && in_array($actionName, $page)){
  	  if($position == 1){
           $xml = '<referenceContainer name="content.top">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPCONTENT . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
      $layout->generateXml();
        
        }
    if($position == 2 ){
    
           $xml = '<referenceContainer name="header.container">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPMENU . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
          $layout->generateXml();
      }

        

      if($position == 3){
         $xml = '<referenceContainer name="page.bottom.container">
          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_BOTTOMPAGE . '">
                               
                            </block>
        </referenceContainer>';
          $layout->getUpdate()->addUpdate($xml);
      $layout->generateXml();
      }

      }

    }
      }
    

     public function combineArray($a, $b)
{
    $aArray = count($a);
    $bArray = count($b);
    $size = ($aArray > $bArray) ? $bArray : $aArray;
    $a = array_slice($a, 0, $size);
    $b = array_slice($b, 0, $size);
    return array_combine($a, $b);
}
    
    public function getDisplayPage(){
     
      $pageConstant = array('cms_index_index', 'checkout_cart_index', 'checkout_index_index');

       $promotionbarCollection = $this->_promotionbar->getPromotionbarCollection();
       
        foreach ($promotionbarCollection as $item) {
           $newArray =[];
          $displayPage = $item->getData('display_onpage');
          $pageArray = explode(',', $displayPage);
          if($pageArray){
             $newArray = $this->combineArray($pageArray, $pageConstant);     
          }
          return $newArray;
          }
      }
   }


