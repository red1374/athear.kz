<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php
    use \Bitrix\Iblock\Elements\ElementCatalogTable;
    $arItems = ElementCatalogTable::getList([
        'select' => [
            'ID',
            'NAME',
            'PREVIEW_TEXT',
        ],
//        'filter' => [
//            'SHORT_NAME.VALUE' => false,
//        ]
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
