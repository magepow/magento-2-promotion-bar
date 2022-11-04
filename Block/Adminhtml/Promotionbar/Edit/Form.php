<?php
namespace Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_options;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magepow\Promotionbar\Model\Status $options,
        array $data = []
    ) 
    {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('wkgrid_');
        // if ($model->getEntityId()) {
        //     $fieldset = $form->addFieldset(
        //         'base_fieldset',
        //         ['legend' => __('Edit Promotionbar'), 'class' => 'fieldset-wide']
        //     );
        //     $fieldset->addField('promotionbar_id', 'hidden', ['name' => 'promotionbar_id']);
        // } else {
        //     $fieldset = $form->addFieldset(
        //         'base_fieldset',
        //         ['legend' => __('Add Promotionbar'), 'class' => 'fieldset-wide']
        //     );
        // }

        // $fieldset->addField(
        //     'name',
        //     'text',
        //     [
        //         'name' => 'name',
        //         'label' => __('Name'),
        //         'id' => 'name',
        //         'title' => __('Name'),
        //         'class' => 'required-entry',
        //         'required' => true,
        //     ]
        // );

       // $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        // $fieldset->addField(
        //     'content',
        //     'editor',
        //     [
        //         'name' => 'content',
        //         'label' => __('Content'),
        //         'style' => 'height:36em;',
        //         'required' => true,
        //         'config' => $wysiwygConfig
        //     ]
        // );

        // $fieldset->addField(
        //     'start_at',
        //     'date',
        //     [
        //         'name' => 'start_at',
        //         'label' => __('Start at'),
        //         'date_format' => $dateFormat,
        //         'time_format' => 'HH:mm:ss',
        //         'class' => 'validate-date validate-date-range date-range-custom_theme-from',
        //         'class' => 'required-entry',
        //         'style' => 'width:200px',
        //     ]
        // );
        //  $fieldset->addField(
        //     'end_at',
        //     'date',
        //     [
        //         'name' => 'end_at',
        //         'label' => __('End at'),
        //         'date_format' => $dateFormat,
        //         'time_format' => 'HH:mm:ss',
        //         'class' => 'validate-date validate-date-range date-range-custom_theme-from',
        //         'class' => 'required-entry',
        //         'style' => 'width:200px',
        //     ]
        // );
        // $fieldset->addField(
        //     'is_active',
        //     'select',
        //     [
        //         'name' => 'is_active',
        //         'label' => __('Status'),
        //         'id' => 'is_active',
        //         'title' => __('Status'),
        //         'values' => $this->_options->getOptionArray(),
        //         'class' => 'status',
        //         'required' => true,
        //     ]
        // );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}