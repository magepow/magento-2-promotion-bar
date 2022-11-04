<?php

namespace Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Rule extends Generic implements TabInterface
{
    protected $_systemStore;
    protected $_objectManager;
    protected $_displaypage;
    protected $_selectpage;
    protected $_renderFieldSet;
    protected $_conditions;
    protected $_showonProductPage;
    protected $_category;
  
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magepow\Promotionbar\Model\Position $options,
        \Magepow\Promotionbar\Model\DisplayPage $displaypage,
        \Magento\Store\Model\System\Store $systemStore,
        \Magepow\Promotionbar\Model\SelectPage $selectpage,
        \Magepow\Promotionbar\Model\ShowOnProductPage $showonProductPage,
        \Magento\Rule\Block\Conditions $conditions,
        \Magepow\Promotionbar\Model\System\Config\Category $category,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset,

        array $data = []
    ) {
    	$this->_showonProductPage = $showonProductPage;
		$this->_systemStore = $systemStore;
        $this->_options = $options;
        $this->_displaypage = $displaypage;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        $this->_selectpage = $selectpage;
        $this->_renderFieldSet = $rendererFieldset;
        $this->_conditions = $conditions;
        $this->_objectManager = $context->getStoreManager();
        $this->_category = $category;

        parent::__construct($context, $registry, $formFactory, $data);
    }
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Promotionbar Rule'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('promotionbar_id', 'hidden', ['name' => 'promotionbar_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Promotionbar Rule'), 'class' => 'fieldset-wide']
            );
        }
         $fieldsetId = 'conditions_fieldset';
        $formName = 'catalog_rule_form';

        $widgetParameters = $model->getParameters();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $modelRule = $objectManager->get('Magento\CatalogWidget\Model\RuleFactory');
        $modelConditions = $modelRule->create();
        if (is_array($widgetParameters))
        {
            $modelConditions->loadPost($widgetParameters);
           $modelConditions->getConditions()->setJsFormObject($fieldsetId);

        }

        $newChildUrl = $this->getUrl(
            'catalog_rule/promo_catalog/newConditionHtml/form/' . $fieldsetId,
            ['form_namespace' => $fieldsetId]
        );

        $renderer = $this->_renderFieldSet->setTemplate('Magento_CatalogRule::promo/fieldset.phtml')
            ->setNewChildUrl($newChildUrl)
            ->setFieldSetId($fieldsetId);
       
        $fieldset->addField(
            'position',
            'select',
            [
                'name' => 'position',
                'label' => __('Position'),
                'title' => __('Position'),
                'values' => $this->_options->toOptionArray(),
            ]
        );

        $field = $fieldset->addField(
            'display_onpage',
            'multiselect',
            [
                'name' => 'display_onpage',
                'label' => __('Select Page'),
                'title' => __('Select Page'),
                'values' => $this->_selectpage->toOptionArray(),
            ]
        ); 

        // $field->setAfterElementHtml(
        // ' <script type="text/javascript">
        // require([
        //         "jquery",
        //         "uiRegistry"
        //     ],  function($, uiRegistry){
        //             jQuery(document).ready(function($) {
        //             $(".field-display_onpage").hide();
        //                 $(".field-category").hide();
                        
        //                 var afterChangeVal = $("#wkgrid_display_page").find(":selected").val();
        //                 if( afterChangeVal == 1) {
        //                             $(".field-display_onpage").show();
        //                 $(".field-category").show();
        //                 $(".field-is_shown_on_productpage").show();
        //                 }else{
        //                 $(".field-display_onpage").hide();
        //                 $(".field-category").hide();
        //                 $(".field-is_shown_on_productpage").hide();
        //                 $(".rule-tree").hide();

                        
        //                 }
        //                 $("#wkgrid_display_page").change(function ()
        //                 {
        //                         var afterChangeVal = $("#wkgrid_display_page").find(":selected").val();
                            
        //                         if( afterChangeVal == 1) {
        //                             $(".field-display_onpage").show();
        //                 $(".field-category").show();
        //                 $(".field-is_shown_on_productpage").show();
        //                 $(".rule-tree").show();
        //                         }else{
        //                         $(".field-display_onpage").hide();
        //                 $(".field-category").hide();
        //                 $(".field-is_shown_on_productpage").hide();
        //                 $(".rule-tree").hide();
                        
        //                         }
        //                     });


        //                 })
        //                 })
        // </script>'
        // );

        // $fieldset->addType(
        //     'categories',
        //     '\Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category'
        // );
        //     $fieldset->addField(
        //     'category',
        //     'categories',
        //     [
        //         'name' => 'category',
        //         'label' => __('Category Page'),
        //         'title' => __('Category Page')
        //     ]
        // );

        $fieldset->addField('category', 'multiselect',
            [
                'label' => __('Category Page(s)'),
                'title' => __('Category Page(s)'),
                'name'  => 'category',
                'values' => $this->_category->toOptionArray()
            ]
        );

        $showonProductPage =  $fieldset->addField(
            'is_shown_on_productpage',
            'select',
            [
                'name' => 'is_shown_on_productpage',
                'label' => __('Show on product page'),
                'title' => __('Show on product page'),
                'values' => $this->_showonProductPage->toOptionArray()
            ]
        );       
                
        $fieldset = $form->addFieldset(
            $fieldsetId,
            ['legend' => __('Conditions (don\'t add conditions if rule is applied to all products)')]
        )->setRenderer($renderer);

        $fieldset->addField(
            'conditions',
            'text',
            [
                'name' => 'conditions',
                'label' => __('Product Page'),
                'title' => __('Product Page'),
                'required' => false,
                'data-form-parts' => $formName
            ]
        )->setRule($modelConditions)->setRenderer($this->_conditions);

        $form->setValues($model->getData());
        $this->setForm($form);
        //show/hide product conditions for product page
        $this->setChild('form_after', $this->getLayout()
		->createBlock('\Magento\Backend\Block\Widget\Form\Element\Dependence')
        ->addFieldMap($showonProductPage->getHtmlId(), $showonProductPage->getName())
        ->addFieldMap( $fieldsetId, $fieldsetId)
        ->addFieldDependence($fieldsetId, $showonProductPage->getName(), 1)
        );
    
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Rule Information');
    }

 
    public function getTabTitle()
    {
        // TODO: Implement getTabTitle() method.
        return __('Rule Information');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     * @api
     */
    public function canShowTab()
    {
        // TODO: Implement canShowTab() method.
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     * @api
     */
    public function isHidden()
    {
        // TODO: Implement isHidden() method.
        return false;
    }
}
