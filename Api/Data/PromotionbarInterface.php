<?php

namespace Magepow\Promotionbar\Api\Data;

 interface PromotionbarInterface
{
  const ENTITY_ID = 'entity_id';
  const NAME = 'name';
  const STORE = 'stores';
  const CUSTOMER_GROUP = 'customer_group';
  const IS_ACTIVE = 'is_active';
  const PROMOTIONBAR_INFO = 'promotionbar_info';
  const END_AT = 'end_at';
  const START_AT = 'start_at';
  const DISPLAY_ONPAGE = 'display_onpage';
  const POSITION = 'position';
  const CONDITIONS = 'conditions_serialized';
  const BACKGROUND_COLOR = 'background_color';
  public function getId();
  public function setId($entityId);
  public function getName();
  public function setName($name);
  public function getStoreView();
  public function setStoreView($stores);
  public function getIsActive();
  public function setIsActive($isActive);
  public function getCustomerGroup();
  public function setCustomerGroup($customerGroup);
  public function getPromotionbarInfo();
  public function setPromotionbarInfo($promotionbarInfo);
  public function getEndAt();
  public function setEndAt($endAt);
  public function getStartAt();
  public function setStartAt($startAt);
  public function getDisplayOnPage();
  public function setDisplayOnPage($displayOnpage);
  public function getConditions();
  public function setConditions($conditions);
  public function getPosition();
  public function setPosition($position);
  public function getBackgroundColor();
  public function setBackgroundColor($backgroundColor);
}