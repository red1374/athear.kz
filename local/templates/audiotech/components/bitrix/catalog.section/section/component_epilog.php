 <? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

    /**
     * @var array $arParams
     * @var array $templateData
     * @var string $templateFolder
     * @var CatalogSectionComponent $component
     */

    global $APPLICATION;

    if ($arResult['HAS_404'] == 'Y'){
        define('ERROR_404', 'Y');
        return "";
    }

    if ($arResult['TITLE']){
        $APPLICATION->SetTitle($arResult['TAG_NAME'] ? $arResult['TAG_NAME'] : $arResult['NAME']);
        $APPLICATION->SetDirProperty('new_title', $arResult['TITLE']);
        $APPLICATION->SetPageProperty('new_title', $arResult['TITLE']);
        foreach($arResult['SECTIONS_PATH'] AS &$arSection){
            $APPLICATION->AddChainItem($arSection['NAME'], str_replace('//', '/', '/'.$arSection['SECTION_PAGE_URL']));
        }
    }
    if ($arResult['DESCRIPTION']){
        $APPLICATION->SetDirProperty('description', $arResult['DESCRIPTION']);
    }
    if ($arResult['TAG_NAME']){
        $APPLICATION->AddChainItem($arResult['TAG_NAME'], '');
    }