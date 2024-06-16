<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementLinksTable;

class SectionLinks extends \CBitrixComponent
{

    public function executeComponent()
    {
        global $APPLICATION;
        $arFilter['filter'] = $this->arParams['SECTION_ID'] !== 'N' ? ['SECTION_IBLOCK_GENERIC_VALUE' => $this->arParams['SECTION_ID']] : null;

        $this->arResult['ITEMS'] = ElementLinksTable::getList([
            'order' => [
                'SORT' => 'ASC',
            ],
            'select' => [
                'ID',
                'NAME',
                'LINK_' => 'LINK',
                'SECTION_' => 'SECTION',
            ],
            'filter' => $arFilter['filter'] ? $arFilter['filter'] : [],
        ])->fetchAll();

        foreach ($this->arResult['ITEMS'] as $key => $arItem)
        {
            if ($arItem['LINK_VALUE'] == $APPLICATION->GetCurPage())
            {
                $this->arResult['ITEMS'][$key]['ACTIVE'] = 'Y';
            }
        }

        $this->includeComponentTemplate();
    }
}