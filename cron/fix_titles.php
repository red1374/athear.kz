<?php
    if (!$_SERVER["DOCUMENT_ROOT"]){
        $_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/..");
        define("CRON_TASK", true);
    }
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    set_time_limit(0);

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);

    use \Bitrix\Iblock\Elements\ElementCatalogTable;
    $arItems = ElementCatalogTable::getList([
        'select' => [
            'ID',
            'NAME',
            'PREVIEW_TEXT',
        ],
        'filter' => [
            'SHORT_NAME.VALUE' => false,
        ]
    ])->fetchAll();

    foreach($arItems AS &$arItem){
        if (preg_match('/СА /s', $arItem['NAME'])){
            CIBlockElement::SetPropertyValuesEx($arItem['ID'], IB_CATALOG_ID, [
                'SHORT_NAME' => CClass::fixItemName($arItem['NAME'], [
                    'SEARCH'    => ['СА ', 'заушный ', 'сверхмощный ', 'мощный ', 'ReSound ', '(', ')'],
                    'REPLACE'   => ['Слуховой аппарат ', '', '', '', '', '', ''],
                ])
            ]);
        }
    }
