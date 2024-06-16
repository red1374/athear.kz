<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }

    use Bitrix\Sale\Internals\StatusLangTable;

    // -- Getting order statuses -------------------------------------------- //
    $arResult['STATUSES'] = StatusLangTable::getList([
        'order' => [
            'STATUS.SORT' => 'ASC'
        ],
        'filter' => [
            'STATUS.TYPE' => 'O',
            'LID'=>LANGUAGE_ID
        ],
        'select' => [
            'STATUS_ID',
            'NAME',
            'DESCRIPTION'
        ],
    ])->fetchAll();

    $res = \Bitrix\Sale\Internals\OrderChangeTable::getList([
        'select'    => ['DATA', 'DATE_CREATE'],
        'filter'    => [
            'ORDER_ID'  => $arResult['ID'],
            'TYPE'      => 'ORDER_STATUS_CHANGED',
            'ENTITY'    => 'ORDER',
        ],
        'order' => ['ID' => 'ASC'],
    ]);
    $arResult['ORDER_STATUS']['N'] = [
        'DATE'  => $arResult['DATE_INSERT_FORMATED'],
    ];
    while($arHistory = $res->fetch()){
        $arTmp = unserialize($arHistory['DATA']);
        $arResult['ORDER_STATUS'][$arTmp['STATUS_ID']] = [
            'DATE'  => $arHistory['DATE_CREATE']->format($arParams['ACTIVE_DATE_FORMAT']),
        ];
    }

    // -- Getting delivery address ------------------------------------------ //
    $arAddress = [];
    if ($arResult['DELIVERY']['ID'] == DELIVERY_SELFPICKUP_ID){
        $arAddress[] = $arResult['DELIVERY']['STORE_LIST'][$arResult['DELIVERY']['STORE'][0]]['ADDRESS'];
    }else{
        foreach($arResult['ORDER_PROPS'] AS &$arItem){
            if ($arItem['PROPS_GROUP_ID'] == 2){
                $arAddress[] = $arItem['VALUE'];
            }
        }
    }
    $arResult['ADDRESS'] = join(', ', $arAddress);

    $arFIO = [];
    // -- Getting user fio from order props --------------------------------- //
    foreach($arResult['ORDER_PROPS'] AS &$arItem){
        if (in_array($arItem['CODE'], ['NAME', 'SECONDNAME', 'LASTNAME']) && $arItem['VALUE']){
            $arFIO[] = $arItem['VALUE'];
        }
    }
    $arResult['FIO']= join(' ', $arFIO);

    if (preg_match('/:/s', $arResult['DELIVERY']['NAME'])){
        $arResult['DELIVERY']['NAME'] = substr($arResult['DELIVERY']['NAME'], 0, strpos($arResult['DELIVERY']['NAME'], ":"));
    }