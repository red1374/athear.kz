<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Catalog\PriceTable;

$arItemsIDs = $arResult['PROPERTIES']['CATALOG_ITEMS']['VALUE'];

$arItems = \Bitrix\Iblock\Elements\ElementCatalogTable::getList([
    'select' => [
        'ID',
        'NAME',
        'CODE',
        'PREVIEW_PICTURE',
    ],
    'filter' => [
        '=ID' => $arItemsIDs,
    ],
])->fetchAll();

$arPrices = PriceTable::getList([
    "select" => [
        'PRICE_SCALE',
        'PRODUCT_ID'
    ],
    "filter" => [
        "=PRODUCT_ID" => $arItemsIDs,
    ],
])->fetchAll();

$arItemsWithPrice = [];

foreach ($arItems as $arItem)
{
    foreach ($arPrices as $arPrice)
    {
        if ($arItem['ID'] == $arPrice['PRODUCT_ID'])
        {
            $arItemsWithPrice[$arItem['ID']] = $arItem;
            $arItemsWithPrice[$arItem['ID']]['PRICE'] = number_format($arPrice['PRICE_SCALE'], 0, '', ' ');
        }
    }
}

$arResult['CATALOG_ITEMS'] = $arItemsWithPrice;