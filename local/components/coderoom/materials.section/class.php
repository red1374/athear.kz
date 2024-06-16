<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\SectionTable;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Uri;

class MaterialsSection extends \CBitrixComponent
{
    private $iBlockID = 14;

    public function executeComponent()
    {
        $arFirstLevelItems = $this->getFirstLevelItems();
        $arSecondLevelItems = $this->getSecondLevelItems($arFirstLevelItems);

        $this->arResult['ITEMS']['FIRST_LEVEL'] = $arFirstLevelItems;
        $this->arResult['ITEMS']['SECOND_LEVEL'] = $arSecondLevelItems;

        $this->includeComponentTemplate();
    }

    private function getFirstLevelItems () : array
    {
        global $APPLICATION;

        $arFirstLevelItems = SectionTable::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'DEPTH_LEVEL'
            ],
            'filter' => [
                'IBLOCK_ID' => $this->iBlockID,
                'DEPTH_LEVEL' => 1,
            ],
        ])->fetchAll();

        foreach ($arFirstLevelItems as $key => $arItem)
        {
            $arFirstLevelItems[$key]['LINK'] = '/customer/materials/' . $arItem['CODE'] . '/';

            if ($arFirstLevelItems[$key]['LINK'] == $APPLICATION->GetCurPage() || strpos($APPLICATION->GetCurPage(), $arFirstLevelItems[$key]['LINK']) !== false)
            {
                $arFirstLevelItems[$key]['ACTIVE'] = 'Y';
            }
        }

        return $arFirstLevelItems;
    }

    private function getSecondLevelItems ($arFirstLevelItems) : array
    {
        global $APPLICATION;
        $iParentID = null;
        $sParentLink = '';

        foreach ($arFirstLevelItems as $arItem)
        {
            if ($arItem['ACTIVE'] == 'Y') {
                $iParentID = $arItem['ID'];
                $sParentLink = $arItem['LINK'];
            }
        }

        $arSecondLevelItems = SectionTable::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_SECTION_ID'
            ],
            'filter' => [
                'IBLOCK_ID' => $this->iBlockID,
                'DEPTH_LEVEL' => 2,
                'IBLOCK_SECTION_ID' => $iParentID,
            ],
        ])->fetchAll();

        foreach ($arSecondLevelItems as $key => $arItem)
        {
            $arSecondLevelItems[$key]['LINK'] = $sParentLink . $arItem['CODE'] . '/';

            if ($arSecondLevelItems[$key]['LINK'] == $APPLICATION->GetCurPage() || strpos($APPLICATION->GetCurPage(), $arSecondLevelItems[$key]['LINK']) !== false)
            {
                $arSecondLevelItems[$key]['ACTIVE'] = 'Y';
            }
        }

        return $arSecondLevelItems;
    }
}