<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "IBLOCK_ID" => '8',
        "SECTION_URL" => '',
        "CACHE_TIME" => '360000'
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);