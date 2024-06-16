<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementQuestionsTable;

class CustomerQuestionsPay extends \CBitrixComponent{
    private $iCacheTime = 3600000;

    public function executeComponent(){
        $obCache    = new CPHPCache;
        $cachePath  = 'CustomerQuestionsSection';
        $cacheID    = $cachePath.$this->arParams['SECTION_ID'];

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

    private function getItems(){
        if ($this->arParams['SORT']){
            $direction = $this->arParams['ORDER'] ? $this->arParams['ORDER'] : 'ASC';
            $arOrder[$this->arParams['SORT']] = 'ASC';
        }else{
            $arOrder = [
                'SORT'  => 'ASC',
            ];
        }

        return ElementQuestionsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_TEXT',
            ],
            'filter' => [
                '=IBLOCK_SECTION_ID' => $this->arParams['SECTION_ID'],
            ],
            'order' => $arOrder,
        ])->fetchAll();
    }
}
