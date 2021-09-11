<?php

namespace Magepow\Promotionbar\Block\Adminhtml\Promotionbar;

class AddRow extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Magepow_Promotionbar';
        $this->_controller = 'adminhtml_promotionbar';
        parent::_construct();
        if ($this->_isAllowedAction('Magepow_Promotionbar::add_row')) {
            $this->buttonList->update('save', 'label', __('Save'));
            $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ]
        );
            
        } else {
            $this->buttonList->remove('save');
        }
        // $this->buttonList->remove('reset');
       
    }


    public function getHeaderText()
    {
        return __('Add Promotionbar Rule');
    }
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }

        return $this->getUrl('*/*/save');
    }
}
