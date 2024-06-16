<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    [
        'IBLOCK_TYPE' => 'menu',
        'IBLOCK_ID' => 2,
        'DEPTH_LEVEL' => 3,
        'SECTION_URL' => '#SECTION_CODE#',
        'CACHE_TIME' => 3600
    ]
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);