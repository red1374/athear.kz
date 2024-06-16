<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

global $APPLICATION;

foreach ($arResult['ITEMS'] as $arItem) {
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