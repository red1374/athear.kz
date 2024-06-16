<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementCatalogTable;

class SimilarElements extends \CBitrixComponent
{
    private $iBlockID = 1;

    public function executeComponent()
    {
        $this->arResult['ITEMS'] = $this->getItems();

        $this->includeComponentTemplate();
    }

    private function getItems ()
    {
        $obItems = ElementCatalogTable::getList([
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'IBLOCK_ID',
                'IBLOCK_SECTION_ID',
                'PREVIEW_PICTURE',
                'OLD_PRICE_' => 'OLD_PRICE',
                'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'
            ],
            'limit' => 8,
            'filter' => [
//                'IBLOCK_SECTION_ID' => $this->arParams['SECTION_ID'],
            ],
        ]);

        $arItems = [];
        $arIDs = [];

        while ($arItem = $obItems->fetch())
        {
            $arItem['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'],  $arItem ,  false ,  'E');
            $arItems[$arItem['ID']] = $arItem;
            $arIDs[] = $arItem['ID'];
        }

        // Цена
        $obPrices = CPrice::GetList(
            [],
            ['PRODUCT_ID' => $arIDs]
        );

        while ($arPrices = $obPrices->fetch())
        {
            $arItems[$arPrices['PRODUCT_ID']]['PRICE'] = $arPrices;
        }

        // Получение раздела
        $arSectionNames = [];

        foreach ($arItems as $arItem)
        {
            $navChain = CIBlockSection::GetNavChain($this->iBlockID, $arItem["IBLOCK_SECTION_ID"]);

            while ($arNav = $navChain->GetNext())
            {
                $dbList = CIBlockSection::GetList(
                    [$by => $order],
                    $arFilter = [
                        "IBLOCK_ID" => $this->iBlockID,
                        "ID" => $arNav["ID"]
                    ],
                    true,
                    $arSelect = [
                        'ID',
                        'NAME'
                    ]
                );

                while ($arInfo = $dbList->Fetch())
                {
                    $arSectionNames[$arItem['ID']] = $arInfo['NAME'];
                }

                break;
            }
        }

        foreach ($arItems as $arItem)
        {
            foreach ($arSectionNames as $itemID => $sectionName)
            {
                if ($itemID == $arItem['ID'])
                {
                    $arItems[$arItem['ID']]['SECTION'] = $sectionName;
                }
            }
        }

        return $arItems;
    }
}