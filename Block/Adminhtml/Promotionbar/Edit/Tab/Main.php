<?php

namespace Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{


    protected $_systemStore;
    protected $_objectManager;
    protected $_customerGroup;
    protected $_options;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
         \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magepow\Promotionbar\Model\Status $options,
        \Magento\Store\Model\System\Store $systemStore,
         \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup,
        array $data = []
    ) {

        $this->_systemStore = $systemStore;
        $this->_options = $options;
        $this->_customerGroup = $customerGroup;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        $this->_objectManager = $context->getStoreManager();

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
 
       $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'id' => 'name',
                'title' => __('Name'),
                'class'=>'required_entry',
                'required' => true,
            ]
        );

        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'stores',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true)
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'stores',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }
       
         $fieldset->addField(
    'customer_group',
    'multiselect',
    [
        'name' => 'customer_group[]',
        'label' => __('Customer Group'),
        'title' => __('Customer Group'),
         'required' => false,
        'values' => $this->_customerGroup->toOptionArray(),
    ]
);
         
      
            $fieldset->addField(
            'sort_order',
            'text',
            [
                'name' => 'sort_order',
                'label' => __('Sort Order'),
                'id' => 'sort_order',
                'title' => __('Sort Order'),
                'required' => true,
            ]
        );
            
      
        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'id' => 'is_active',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
         $fieldset->addField(
            'start_at',
            'date',
            [
                'name' => 'start_at',
                'label' => __('Start at'),
                'date_format' => $dateFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
                'required' => true
            ]
        );
         $fieldset->addField(
            'end_at',
            'date',
            [
                'name' => 'end_at',
                'label' => __('End at'),
                'date_format' => $dateFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
                'required' => true
            ]
        );        

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();

    }

    public function getTabLabel()
    {
        return __('General Information');
    }

 
    public function getTabTitle()
    {
        // TODO: Implement getTabTitle() method.
        return __('General Information');
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