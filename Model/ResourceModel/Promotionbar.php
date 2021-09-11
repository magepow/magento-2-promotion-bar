<?php
namespace Magepow\Promotionbar\Model\ResourceModel;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;

class Promotionbar extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		
      
        
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('promotionbar_management', 'entity_id');
	}
}