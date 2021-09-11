<?php
namespace Magepow\Promotionbar\Model;
 use Magepow\Promotionbar\Api\Data\PromotionbarInterface;
class Promotionbar extends \Magento\Framework\Model\AbstractModel implements PromotionbarInterface
{
	const CACHE_TAG = 'promotionbar_management';

	protected $_cacheTag = 'promotionbar_management';

	protected $_eventPrefix = 'promotionbar_management';

	protected function _construct()
	{
		$this->_init('Magepow\Promotionbar\Model\ResourceModel\Promotionbar');
	}
   

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
	 public function getId(){
	 	return $this->getData(self::ENTITY_ID);
	 }
  public function setId($entityId){
  		return $this->setData(self::ENTITY_ID, $entityId);
  }
  public function getName(){
  		return $this->getData(self::NAME);
  }
  public function setName($name){
  		return $this->setData(self::NAME, $name);
  }
  public function getStoreView(){
  		return $this->getData(self::STORE);
  }
  public function setStoreView($stores){
  		return $this->setData(self::STORE, $stores);
  }
  public function getIsActive(){
  		return $this->getData(self::IS_ACTIVE);
  }
  public function setIsActive($isActive){
  		return $this->setData(self::IS_ACTIVE, $is_active);
  }
  public function getCustomerGroup(){
  		return $this->getData(self::CUSTOMER_GROUP);
  }
  public function setCustomerGroup($customerGroup){
  		return $this->setData(self::CUSTOMER_GROUP, $customerGroup);
  }
  public function getPromotionbarInfo(){
  		return $this->getData(self::PROMOTIONBAR_INFO);
  }
  public function setPromotionbarInfo($promotionbarInfo){
  		return $this->setData(self::PROMOTIONBAR_INFO, $promotionbarInfo);
  }
  public function getEndAt(){
  		return $this->getData(self::END_AT);
  }
  public function setEndAt($endAt){
  		return $this->setData(self::END_AT, $endAt);
  }
  public function getStartAt(){
  		return $this->getData(self::START_AT);
  }
  public function setStartAt($startAt){
  		return $this->setData(self::START_AT, $startAt);
  }
  public function getDisplayOnPage(){
  		return $this->getData(self::DISPLAY_ONPAGE);
  }
  public function setDisplayOnPage($displayOnpage){
  		return $this->setData(self::DISPLAY_ONPAGE, $displayOnpage);
  }
  public function getConditions(){
  		return $this->getData(self::CONDITIONS);
  }
  public function setConditions($conditions){
  		return $this->setData(self::CONDITIONS, $conditions);
  }
  public function getPosition(){
  		return $this->getData(self::POSITION);
  }
  public function setPosition($position){
  		return $this->setData(self::POSITION, $position);
  }
  public function getBackgroundColor(){
  		return $this->getData(self::BACKGROUND_COLOR);
  }
  public function setBackgroundColor($backgroundColor){
  		return $this->setData(self::BACKGROUND_COLOR, $backgroundColor);
  }
}
	
