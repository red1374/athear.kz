<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @var array $arResult
 * @global CMain $APPLICATION
 */

global $APPLICATION;

// -- Update META properties ------------------------------------------------ //
$title = $arResult['PROPERTIES']['SHORT_NAME']['VALUE'];
$titleFirstSmall = CClass::mb_lcfirst($title);

foreach($arResult['META_TAGS'] AS &$metaProp){
    if (strpos($metaProp, $title)){
        $metaProp = str_replace($title, $titleFirstSmall, $metaProp);
    }
}

$GLOBALS['TITLE'] = $arResult['META_TAGS']['TITLE'];
if (!empty($arResult['SECTION']['PATH'])){
    //$APPLICATION->AddChainItem($arResult['SECTION']['PATH'][0]['NAME'], $arResult['SECTION']['PATH'][0]['SECTION_PAGE_URL']);
}
if (!empty($GLOBALS['TITLE'])){
    $APPLICATION->AddChainItem($GLOBALS['TITLE'], '');
}
if (!empty($arResult['META_TAGS'])){
    if (isset($arResult['META_TAGS']['BROWSER_TITLE'])){
        $APPLICATION->SetDirProperty('new_title', $arResult['META_TAGS']['BROWSER_TITLE']);
        $APPLICATION->SetPageProperty('new_title', $arResult['META_TAGS']['BROWSER_TITLE']);
    }
}
