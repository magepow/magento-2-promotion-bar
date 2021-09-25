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
   const TEMPLATE_TOPCONTENT = 'Magepow_Promotionbar::promotionbar_topcontent.phtml';
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
    $promotionbarCollection = $this->_promotionbar->getPromotionbarCollection();
          foreach ($promotionbarCollection as  $value) {
            $position = $value->getPosition(); 
            $displayPage = $value->getDisplayOnpage();
            $arrayPage = array($displayPage);
            $category = $value->getCategory();
            $categoryArray = array($category);
          

          if($actionName == 'catalog_category_view' 
            || $actionName = "catalog_product_view" 
            || $actionName == 'cms_index_index' && in_array($actionName, $arrayPage)
            ||$actionName == 'checkout_index_index' && in_array($actionName, $arrayPage)
            ||$actionName == 'checkout_cart_index' && in_array($actionName, $arrayPage)){
            if($position == 1){
                $xml = '<referenceContainer name="content.top">
                          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPCONTENT . '">
                               </block>
                        </referenceContainer>';
                    $layout->getUpdate()->addUpdate($xml);
                   $layout->generateXml();
            }
            if($position == 2){

               $xml = '<referenceContainer name="header.container">
                          <block class="' . self::BLOCK . '" template="' . self::TEMPLATE_TOPMENU . '">
                               
                            </block>
                        </referenceContainer>';
                    $layout->getUpdate()->addUpdate($xml);
                    $layout->generateXml();
            }
            if($position == 3) {
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
}



