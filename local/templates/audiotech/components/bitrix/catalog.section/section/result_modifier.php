<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

    /**
     * @var array $arParams
     * @var array $arResult
     * @var array $templateData
     * @var string $templateFolder
     * @var CatalogSectionComponent $component
     */

    global $APPLICATION;

    foreach($arResult['ITEMS'] AS &$arItem) {
        if ($arItem['PROPERTIES']['SHORT_NAME']['VALUE']){
            $arItem['NAME'] = $arItem['PROPERTIES']['SHORT_NAME']['VALUE'];
        }

        if ($arItem["PREVIEW_PICTURE"]){
            $arItem["RESIZED"] = CFile::ResizeImageGet(
                $arItem["PREVIEW_PICTURE"],
                [
                    'width' => 630,
                    'height'=> 500,
                ],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
        }else{
            $arItem["RESIZED"]['src'] =SITE_TEMPLATE_PATH . '/images/no-photo.png';
        }

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

            while ($arInfo = $dbList->Fetch()) {
                $arSectionNames[$arItem['ID']] = $arInfo['NAME'];
            }

            break;
        }
    }

    $arResult['SECTIONS_NAME'] = $arSectionNames;

    // -- Get section tag data ---------------------------------------------- //
    if ($_GET['TAG']){
        $arResult['TAG_DATA']   = CCustomCatalog::getTagData(
            $_GET['TAG'], $arResult['ID'],
            ['SECTION_' => 'SECTION', 'TITLE_' => 'TITLE', 'TITLE_SLUG_' => 'TITLE_SLUG'],
            ['ID', 'NAME', 'PREVIEW_TEXT'],
        );

        if ((int)$arResult['TAG_DATA']['PROPS']['SECTION'] != $arResult['ID']){
            unset($arResult['TAG_DATA']);
        }else{
            $tag_description = $arResult['TAG_DATA']['FIELDS']['PREVIEW_TEXT'];
            unset($_GET['set_filter']);
            $arResult['TAG_NAME'] = $arResult['TAG_DATA']['PROPS']['TITLE'] ?
                $arResult['TAG_DATA']['PROPS']['TITLE'] : $arResult['TAG_DATA']['FIELDS']['NAME'];

            $slug       = $arResult['TAG_DATA']['PROPS']['TITLE_SLUG'] ? $arResult['TAG_DATA']['PROPS']['TITLE_SLUG'] : $arResult["TAG_NAME"];
            $tag_title  = $arResult["TAG_NAME"]." - купить ".$slug." в Казахстане в центрах слуха Audiotech";
        }
    }

    $arSections = CCache::getCatalogSections($arParams['IBLOCK_ID']);
    $arResult['SECTIONS_PATH'] = CClass::getSectionsPath($arResult['ID'], $arSections);
    if (!empty($arResult['SECTIONS_PATH'])){
        $arResult['SECTIONS_PATH'] = array_reverse($arResult['SECTIONS_PATH']);
    }
    $arSection  = $arSections[$arResult['ID']];
    if ($arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"]){
        $title  = $arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"];
    }else{
        $slug   = $arSection['UF_SEO_SLUG'] ? $arSection['UF_SEO_SLUG'] : $arResult["NAME"];
        $title  = $arResult["NAME"]." - купить ".$arSection['UF_SEO_SLUG']." в Москве, цены в церковной лавке";
    }
    $arResult["TITLE"] = $GLOBALS['TITLE'] = $tag_title ? $tag_title : $title;
    $arResult["SECTION_LIST_NAME"] = $arResult['TAG_NAME'] ? $arResult['TAG_NAME'] : $arResult['NAME'];
    $arResult["DESCRIPTION"] = str_replace([
        '{H1}', '<ITEMS_COUNT>', '<MIN_PRICE>'
        ],[
            $arResult["SECTION_LIST_NAME"],
            $arResult['NAV_RESULT']->NavRecordCount,
            $arSection['UF_MIN_PRICE'],
        ],
        $tag_description ? $tag_description : $arResult["DESCRIPTION"]
    );
    if (!$arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"]){
        $arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"] = strip_tags($arResult["DESCRIPTION"]);
    }
    if ($_GET["PAGEN_" .  $arResult['NAV_RESULT']->NavNum] > 0 &&
            $arResult['NAV_RESULT']->NavPageNomer != $_GET["PAGEN_" .  $arResult['NAV_RESULT']->NavNum]) {
        $arResult['HAS_404'] = 'Y';
    }
    $this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys, [
        'TITLE', 'SECTIONS_PATH', 'DESCRIPTION', 'TAG_NAME', 'NAME', 'SECTION_LIST_NAME', 'HAS_404',
    ]);