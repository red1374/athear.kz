<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementSpecialistsTable;
use \Bitrix\Iblock\Elements\ElementPricesTable;

$arResult['SPECIALISTS'] = ElementSpecialistsTable::getList([
    'select' => [
        'ID',
        'NAME',
        'PREVIEW_PICTURE',
        'PREVIEW_TEXT',
        'SPECIALIZATION_' => 'SPECIALIZATION',
        'WORK_LOCATION_' => 'WORK_LOCATION'
    ],
    'filter' => [
        '=ID' => $arResult['PROPERTIES']['SPECIALISTS']['VALUE'],
    ]
])->fetchAll();

$arResult['PRICES'] = ElementPricesTable::getList([
    'select' => [
        'ID',
        'NAME',
        'PREVIEW_TEXT',
    ],
    'filter' => [
        '=ID' => $arResult['PROPERTIES']['PRICES_FOR_SERVICES']['VALUE'],
    ]
])->fetchAll();