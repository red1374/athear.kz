<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", 
	"", 
	array(
		"IBLOCK_ID" => "24",
		"SECTION_URL" => "",
		"CACHE_TIME" => "360000",
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"IBLOCK_TYPE" => "content",
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "A"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);