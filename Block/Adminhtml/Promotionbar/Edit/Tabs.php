<?php

namespace Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit;
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;


class Tabs extends WidgetTabs
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('promotionbar_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Promotionbar Information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'main_section',
            [
                'label' => __('General Information'),
                'title' => __('General Information'),
                'content' => $this->getLayout()->createBlock(
                    'Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit\Tab\Main'
                )->toHtml(),
            ]
        );
        $this->addTab(
            'rule',
            [
                'label' => __('Rule Information'),
                'title' => __('Rule Information'),
                'content' => $this->getLayout()->createBlock(
                    'Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit\Tab\Rule'
                )->toHtml(),
            ]
        );
          $this->addTab(
            'design',
            [
                'label' => __('Design Information'),
                'title' => __('Design Information'),
                'content' => $this->getLayout()->createBlock(
                    'Magepow\Promotionbar\Block\Adminhtml\Promotionbar\Edit\Tab\Design'
                )->toHtml(),
            ]
        );
        

        return parent::_beforeToHtml();
    }
}


