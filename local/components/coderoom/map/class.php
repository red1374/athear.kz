<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CMap extends \CBitrixComponent
{
    private $iCacheTime = 3600000;
    private $max_items  = 20;

    public function executeComponent(){
        $obCache    = new CPHPCache;
        $cachePath  = 'MapSection';
        $cacheID    = $cachePath.$this->arParams['MAP_ID'].$this->arParams['IBLOCK_ID'];

        if ($obCache->initCache($this->iCacheTime, $cacheID, $cachePath)) {
            $vars = $obCache->GetVars();

            $this->arResult = $vars['arResult'];
        } else if ($obCache->StartDataCache()) {
            $this->arResult['ITEMS'] = $this->getItems();

            $obCache->EndDataCache([
                'arResult' => $this->arResult,
            ]);
        }

        $this->includeComponentTemplate();
    }

    private function getEntityClass() {
        if (!(int)$this->arParams['IBLOCK_ID']){
            return false;
        }

        return \Bitrix\Iblock\Iblock::wakeUp($this->arParams['IBLOCK_ID'])->getEntityDataClass();
    }

    private function getItems(){
        if ($entity = $this->getEntityClass()){
            $arFields = [
                 'ID',
                'NAME',
            ];

            if (!empty($this->arParams['FIELDS'])){
                $arFields = array_merge($arFields, $this->arParams['FIELDS']);
            }

            return $entity::getList([
                'select' => $arFields,
                'filter' => [
                    'ACTIVE'    => 'Y',
                ],
                'limit' => (int)$this->arParams['ITEMS_COUNT'] ? $this->arParams['ITEMS_COUNT'] : $this->max_items,
            ])->fetchAll();
        }

        return [];
    }
}