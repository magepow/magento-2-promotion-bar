<?php

namespace Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Design extends Generic implements TabInterface
{


    protected $_systemStore;
    protected $_objectManager;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
         \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {

        $this->_systemStore = $systemStore;
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
                ['legend' => __('Edit Promotionbar Design'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('promotionbar_id', 'hidden', ['name' => 'promotionbar_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Promotionbar Design'), 'class' => 'fieldset-wide']
            );
        }
  // $field = $fieldset->addField(
  //           'background_color',
  //           'text',
  //           [
  //               'name' => 'background_color',
  //               'label' => __('Background Color'),
  //               'id' => 'background_color',
  //               'title' => __('Background color'),
  //               'required' => false,
  //           ]
  //       );
  //        $renderer = $this->getLayout()->createBlock('Magepow\Promotionbar\Block\Adminhtml\Color');
  //        $field->setRenderer($renderer);

         $fieldset->addField(
            'promotionbar_info',
            'editor',
            [
                'name' => 'promotionbar_info',
                'label' => __('Content'),
                'id' => 'promotionbar_info',
                'title' => __('Content'),
                 'config'    => $this->_wysiwygConfig->getConfig(),
                // 'class' => 'required_entry',
                 'wysiwyg'   => true,
                'required' => true,
            ]
        );
        
        


        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();

    }

    public function getTabLabel()
    {
        return __('Design Information');
    }

 
    public function getTabTitle()
    {
        // TODO: Implement getTabTitle() method.
        return __('Design Information');
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