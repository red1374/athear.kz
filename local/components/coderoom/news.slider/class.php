<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementNewsTable;
use \Bitrix\Iblock\Elements\ElementBlogTable;
use \Bitrix\Iblock\SectionTable;

class NewsSlider extends \CBitrixComponent
{
    private $iBlockNewsID = 8;
    private $iBlockBlogID = 24;
    private $iCacheTime = 3600000;
    private $sCacheId = 'NewsSlider';
    private $sCachePath = 'NewsSlider/';

    public function executeComponent()
    {
        $obCache = new CPHPCache;

        $this->sCacheId = substr(md5(join($this->arParams)), 0, 7);
        if ($obCache->initCache($this->iCacheTime, $this->sCacheId, $this->sCachePath)) {
            $vars = $obCache->GetVars();

            $this->arResult = $vars['arResult'];
        } else if ($obCache->StartDataCache()) {
            if ($this->arParams['IS_BLOG'] == 'Y') {
                $this->arResult['ITEMS'] = $this->getBlog();
            } else {
                $this->arResult['ITEMS'] = $this->getNews();
            }

            $obCache->EndDataCache([
                'arResult' => $this->arResult,
            ]);
        }

        $this->includeComponentTemplate();
    }

    private function getNews ()
    {
        $arItems = ElementNewsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'TIMESTAMP_X',
                'CODE',
                'PREVIEW_PICTURE',
                'IBLOCK_SECTION_ID',
                'PREVIEW_TEXT'
            ],
            'limit' => 4,
            'filter' => [
                '!ID' => $this->arParams['ELEMENT_ID'],
            ]
        ])->fetchAll();

        $arSectionsIDs = [];

        foreach ($arItems as $arItem)
        {
            $arSectionsIDs[] = $arItem['IBLOCK_SECTION_ID'];
        }

        $arSections = SectionTable::getList([
            'select' => [
                'ID',
                'CODE',
            ],
            'filter' => [
                'IBLOCK_ID' => $this->iBlockNewsID,
                'DEPTH_LEVEL' => 1,
                '=ID' => $arSectionsIDs,
            ],
        ])->fetchAll();

        $arNewItems = [];

        foreach ($arItems as $arItem)
        {
            $arNewItems[$arItem['ID']] = $arItem;

            foreach ($arSections as $arSection)
            {
                if ($arItem['IBLOCK_SECTION_ID'] == $arSection['ID'])
                {
                    $arNewItems[$arItem['ID']]['SECTION_CODE'] = $arSection['CODE'];
                }
            }
        }

        return $arNewItems;
    }

    private function getBlog (){
        $arItems = ElementBlogTable::getList([
            'select' => [
                'ID',
                'NAME',
                'TIMESTAMP_X',
                'CODE',
                'PREVIEW_PICTURE',
                'IBLOCK_SECTION_ID',
                'PREVIEW_TEXT'
            ],
            'limit' => 4,
            'filter' => [
                '!=ID' => $this->arParams['ELEMENT_ID'],
            ]
        ])->fetchAll();

        $arSectionsIDs = [];

        foreach ($arItems as $arItem)
        {
            $arSectionsIDs[] = $arItem['IBLOCK_SECTION_ID'];
        }

        $arSections = SectionTable::getList([
            'select' => [
                'ID',
                'CODE',
            ],
            'filter' => [
                'IBLOCK_ID' => $this->iBlockBlogID,
                'DEPTH_LEVEL' => 1,
                '=ID' => $arSectionsIDs,
            ],
        ])->fetchAll();

        $arNewItems = [];

        foreach ($arItems as $arItem)
        {
            $arNewItems[$arItem['ID']] = $arItem;

            foreach ($arSections as $arSection)
            {
                if ($arItem['IBLOCK_SECTION_ID'] == $arSection['ID'])
                {
                    $arNewItems[$arItem['ID']]['SECTION_CODE'] = $arSection['CODE'];
                }
            }
        }

        return $arNewItems;
    }
}