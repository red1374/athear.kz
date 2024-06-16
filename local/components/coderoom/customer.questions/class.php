<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementQuestionsTable;
use \Bitrix\Iblock\SectionTable;

class CustomerQuestions extends \CBitrixComponent
{
    private $iPaySectionID = 22;
    private $iCacheTime = 3600000;
    private $sCacheId = 'CustomerQuestions';
    private $sCachePath = 'CustomerQuestions/';

    public function executeComponent()
    {
        $obCache = new CPHPCache;

        if ($obCache->initCache($this->iCacheTime, $this->sCacheId, $this->sCachePath)) {
            $vars = $obCache->GetVars();

            $this->arResult = $vars['arResult'];
        } else if ($obCache->StartDataCache()) {
            $arItems = $this->getItems();
            $arSections = $this->getSections($arItems);

            $this->arResult['ITEMS']['ELEMENTS'] = $arItems;
            $this->arResult['ITEMS']['SECTIONS'] = $arSections;

            $obCache->EndDataCache([
                'arResult' => $this->arResult,
            ]);
        }

        $this->includeComponentTemplate();
    }

    private function getItems ()
    {
        return ElementQuestionsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_TEXT',
                'IBLOCK_SECTION_ID'
            ],
        ])->fetchAll();
    }

    private function getSections ($arItems)
    {
        $arIDs = [];

        foreach ($arItems as $arItem)
        {
            $arIDs[$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];
        }

        return SectionTable::getList([
            'select' => [
                'ID',
                'NAME',
            ],
            'filter' => [
              '=ID' => $arIDs,
            ],
        ])->fetchAll();
    }
}