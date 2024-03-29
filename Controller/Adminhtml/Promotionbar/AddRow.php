<?php

namespace Magepow\Promotionbar\Controller\Adminhtml\Promotionbar;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    private $coreRegistry;
    private $promotionbarFactory;
    private $_json;

    public function __construct(
        \Magento\Backend\App\Action\Context $context, 
        \Magento\Framework\Registry $coreRegistry,
        \Magepow\Promotionbar\Model\PromotionbarFactory $promotionbarFactory,
        \Magepow\Promotionbar\Serialize\Serializer\Json $json
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->promotionbarFactory = $promotionbarFactory;
        $this->_json = $json;
    }

    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->promotionbarFactory->create();

        if ($rowId) {
            $rowData = $rowData->load($rowId);

            $rowData->setData('promotionbar_id', $rowData->getEntityId());

            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('data no longer exist.'));
                $this->_redirect('magepow_promotionbar/promotionbar/rowdata');

                return ;
             }
              else{        
            
                $tmp = $this->_json->unserialize($rowData->getConditionsSerialized());
                if(is_array($tmp)){
                    unset($tmp['form_key']);
                    unset($tmp['entity_id']);
                    $rowData->addData($tmp);
                }
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Promotionbar ').$rowTitle : __('Add Promotionbar');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

}