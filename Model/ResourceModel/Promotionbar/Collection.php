<?php
namespace Magepow\Promotionbar\Model\ResourceModel\Promotionbar;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'entity_id';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
	$this->_init('Magepow\Promotionbar\Model\Promotionbar',
		'Magepow\Promotionbar\Model\ResourceModel\Promotionbar');
	}

}
