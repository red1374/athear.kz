<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

use \Coderoom\Main\Favorite\listfavorite;
use \Coderoom\Main\Cart\ListCart;
use \Bitrix\Iblock\Elements\ElementCatalogTable;

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Слайдер
$arPhotos = [];

if ($arResult['DETAIL_PICTURE']['ID']){
    $arPhotos[] = [
        'THUMB' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ['width' => 95, 'height' => 95]),
        'BIG' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], ['width' => 1280, 'height' => 1024]),
        'MAIN' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], ['width' => 600, 'height' => 600]),
    ];
}

if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])){
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] AS &$iPhotoID){
        $arPhotos[] = [
            'THUMB' => CFile::ResizeImageGet($iPhotoID, ['width' => 95, 'height' => 95]),
            'BIG' => CFile::ResizeImageGet($iPhotoID, ['width' => 1280, 'height' => 1024]),
            'MAIN' => CFile::ResizeImageGet($iPhotoID, ['width' => 600, 'height' => 600]),
        ];
    }
}

$arResult['SLIDER'] = $arPhotos;

// Файлы
if ($arResult['PROPERTIES']['FILES']['VALUE']){
    $arFiles = [];

    foreach ($arResult['PROPERTIES']['FILES']['VALUE'] AS &$iFileID){
        $arFiles[] = CFile::GetFileArray($iFileID);
    }

    $arResult['FILES'] = $arFiles;
}

// Привязанные товары
if ($arResult['PROPERTIES']['ADD_ELEMENTS']['VALUE']){
    $obItems = ElementCatalogTable::getList([
        'select' => [
            'ID',
            'NAME',
            'CODE',
            'IBLOCK_ID',
            'IBLOCK_SECTION_ID',
            'PREVIEW_PICTURE',
            'OLD_PRICE_' => 'OLD_PRICE',
            'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'
        ],
        'filter' => [
            '=ID' => $arResult['PROPERTIES']['ADD_ELEMENTS']['VALUE'],
        ]
    ]);

    $arItems = [];

    // Детальная страница
    while ($arItem  =  $obItems ->fetch()) {
        $arItem['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'],  $arItem ,  false ,  'E');
        $arItems[$arItem['ID']] = $arItem;
    }

    // Цена
    $obPrices = CPrice::GetList(
        [],
        ['PRODUCT_ID' => $arResult['PROPERTIES']['ADD_ELEMENTS']['VALUE']]
    );

    while ($arPrices = $obPrices->fetch()) {
        $arItems[$arPrices['PRODUCT_ID']]['PRICE'] = $arPrices;
    }

    // Получение раздела
    $arSectionNames = [];

    foreach ($arItems AS &$arItem){
        $navChain = CIBlockSection::GetNavChain($arParams["IBLOCK_ID"], $arItem["IBLOCK_SECTION_ID"]);

        while ($arNav = $navChain->GetNext()) {
            $dbList = CIBlockSection::GetList(
                [$by => $order],
                $arFilter = [
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ID" => $arNav["ID"]
                ],
                true,
                $arSelect = [
                    'ID',
                    'NAME'
                ]
            );

            while ($arInfo = $dbList->Fetch()){
                $arSectionNames[$arItem['ID']] = $arInfo['NAME'];
            }

            break;
        }
    }

    foreach ($arItems AS &$arItem){
        foreach ($arSectionNames AS $itemID => &$sectionName){
            if ($itemID == $arItem['ID']){
                $arItems[$arItem['ID']]['SECTION'] = $sectionName;
            }
        }
    }

    $arResult['ADD_ELEMENTS'] = $arItems;
}

$obFavoriteList = new ListFavorite;
$arFavoriteItemsIDs = $obFavoriteList->getListIDS();

foreach ($arFavoriteItemsIDs AS &$id){
    if ($id == $arResult['ID']){
        $arResult['IS_FAVORITE_ITEM'] = 'Y';
    }
}

$obCartList = new ListCart;
$obCartListItemIDs = $obCartList->getListIDS();
$arCartItems = $obCartList->getListItems();

foreach ($obCartListItemIDs AS &$id){
    if ($id == $arResult['ID']){
        $arResult['IS_CART_ITEM'] = 'Y';
    }
}

foreach ($arCartItems AS &$arItem){
    if ($arItem['PRODUCT_ID'] == $arResult['ID']){
        $arResult['CART_QUANTITY'] = number_format($arItem['QUANTITY'], 0,);
    }
}


    $arChain = CIBlockSection::GetNavChain($arParams["IBLOCK_ID"], $arResult["IBLOCK_SECTION_ID"])->fetch();

    $arResult['ROOT_SECTION_ID'] = $arChain['ID'];
    $arResult['TITLE'] = $arResult['PROPERTIES']['SHORT_NAME']['VALUE'] ? $arResult['PROPERTIES']['SHORT_NAME']['VALUE'] : $arItem['NAME'];

    $this->__component->arResultCacheKeys = array_merge(
        $this->__component->arResultCacheKeys,
        ['TITLE', 'DETAIL_PAGE_URL', 'META_TAGS', 'PROPERTIES']
    );