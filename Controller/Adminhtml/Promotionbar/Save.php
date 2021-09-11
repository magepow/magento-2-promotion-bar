<?php

namespace Magepow\Promotionbar\Controller\Adminhtml\Promotionbar;
class Save extends \Magento\Backend\App\Action 
{
    protected $_promotionbarFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magepow\Promotionbar\Model\PromotionbarFactory $promotionbarFactory

    ) {
        parent::__construct($context);
        $this->_promotionbarFactory = $promotionbarFactory;
    }
    // public function serialize($data)
    // {

    //     $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    //     $serializer = $objectManager->create(\Magento\Framework\Serialize\SerializerInterface::class);
    //     return $serializer->serialize($data);
    // }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        // check if data sent
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('promotionbar_id');
            if($id) $data['entity_id'] = $id; // fix conflict entity_id in product condition
            $model = $this->_promotionbarFactory->create();

            $storeViewId = $this->getRequest()->getParam('stores');
            $model->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This item no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

              if (isset($data['category'])){

                $data['category'] = implode(',', $data['category']);
                
                     
            }
              $data['conditions_serialized'] = @serialize($data);
              
              if (isset($data['display_onpage'])) $data['display_onpage'] = implode(',', $data['display_onpage']);
             if(isset($data['customer_group'])) $data['customer_group'] = implode(',', $data['customer_group']);
            if (isset($data['stores'])) $data['stores'] = implode(',', $data['stores']);
            $model->setData($data)->setStoreViewId($storeViewId);;

            // try to save it
            try {

                $model->save();
                // display success message
                $this->messageManager->addSuccess(__('You saved the item.'));

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/addrow', ['id' => $model->getId(), '_current' => true]);
                    return;
                }

                // go to grid
                return $resultRedirect->setPath('*/*/index');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // save data in session
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                // redirect to edit form
                return $resultRedirect->setPath('*/*/addrow', ['id' => $this->getRequest()->getParam('id')]);
            }
        }

        return $resultRedirect->setPath('*/*/index');
    }
     protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magepow_Promotionbar::save');
    }
}
