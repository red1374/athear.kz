<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>
<div class="news">
    <? foreach ($arResult["ITEMS"] AS &$arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
   ?>
        <div class="article-preview">
            <? if (!empty($arItem['RESIZED']))?>
            <a class="article-preview__pic" href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
                <img src="<?=$arItem['RESIZED']["src"]?>" alt="<?=$arItem["NAME"]?>">
            </a>
            <div class="article-preview__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
            <a class="article-preview__name" title="<?=$arItem["NAME"]?>"
               href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
            <? if (!empty($arItem['PREVIEW_TEXT'])):?>
            <p class="article-preview__text"><?=$arItem['PREVIEW_TEXT']?></p>
            <? endif?>
        </div>
    <? endforeach?>
    <? if (!empty($arResult['ITEMS']) && count($arResult['ITEMS']) == 1) {?>
        <div></div>
    <? }?>
    <? if (count($arResult["ITEMS"]) > 0) {?>
        <div class="form_container subscribe email_form" data-name="subscribe_aside"></div>
    <? }?>
    <? if (empty($arResult['ITEMS'])) {?>
        <p>Новостей не найдено.</p>
    <? }?>
</div>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) {?>
    <div class="pagination">
        <?=$arResult["NAV_STRING"]?>
    </div>
<? } else {?>
    <div class="news-bottom"></div>
<? }
