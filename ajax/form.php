<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();
$arForm = $request->getPostList()->toArray();

$PROP = [];

foreach ($arForm as $key => $value)
{
    if ($key == 'name') {
        $PROP['NAME'] = $value;
    } else if ($key == 'phone') {
        $PROP['PHONE'] = $value;
    } else if ($key == 'email') {
        $PROP['EMAIL'] = $value;
    } else if ($key == 'center') {
        $PROP['CENTER'] = $value;
    } else if ($key == 'reception') {
        $PROP['RECEPTION'] = $value;
    } else if ($key == 'date') {
        $PROP['DATE'] = $value;
    } else if ($key == 'time') {
        $PROP['TIME'] = $value;
    } else if ($key == 'message') {
        $PROP['COMMENT'] = $value;
    } else if ($key == 'doctor') {
        $PROP['DOCTOR'] = $value;
    }
}

$element = new CIBlockElement;

if ($arForm['formName'] == 'Запись на приём')
{
    $arElement = [
        'IBLOCK_ID' => 17,
        'PROPERTY_VALUES' => $PROP,
        'NAME' => $PROP['NAME'],
        'ACTIVE' => 'Y',
    ];

    $element->Add($arElement);
    echo 'ok';
} else if ($arForm['formName'] == 'Заказать звонок')
{
    $arElement = [
        'IBLOCK_ID' => 18,
        'PROPERTY_VALUES' => $PROP,
        'NAME' => $PROP['NAME'],
        'ACTIVE' => 'Y',
    ];

    $element->Add($arElement);
    echo 'ok';
} else if ($arForm['formName'] == 'Подписаться на рассылку')
{
    $arElement = [
        'IBLOCK_ID' => 19,
        'NAME' => $PROP['EMAIL'],
        'ACTIVE' => 'Y',
    ];

    $element->Add($arElement);
    echo 'ok';
} else if ($arForm['formName'] == 'Задать вопрос')
{
    $arElement = [
        'IBLOCK_ID' => 20,
        'PROPERTY_VALUES' => $PROP,
        'NAME' => $PROP['NAME'],
        'ACTIVE' => 'Y',
    ];

    $element->Add($arElement);
    echo 'ok';
}