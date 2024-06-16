<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

    if (!$arResult["NavShowAlways"]){
        if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
            return;
    }

    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
    $arResult["nStartPage"] = 1;
?>
<div class="pagination__list <?php if ($arResult["nEndPage"] == 2) echo 'two'; ?>">
    <? if ($arResult["NavPageNomer"] != 1):?>
    <a class="pagination__page pagination__prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 5L4 12M4 12L11 19M4 12H20" stroke="#131313" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"/>
        </svg>
    </a>
    <? else:?>
    <span class="pagination-empty"></span>
    <? endif?>
    <div class="pagination-wrapper">
    <? while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
        <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <span class="pagination__page active"><?=$arResult["nStartPage"]?></span>
        <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
            <a class="pagination__page" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
        <?elseif ($arResult["nStartPage"] <= 2 ||
                $arResult["NavPageCount"] - $arResult["nStartPage"] <= 1 ||
                abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2):?>
            <a class="pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
        <?else:
            $middle = round( ($arResult["nStartPage"] < $arResult["NavPageNomer"]) ?  $arResult["NavPageNomer"] / 2 : ( ($arResult["nEndPage"] + $arResult["NavPageNomer"]) / 2));
        ?>
            <a class="pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middle?>">...</a>
        <?endif;
        $arResult["nStartPage"]++?>
    <?endwhile?>
    </div>
    <? if ($arResult["NavPageNomer"] != $arResult["nEndPage"]):?>
    <a class="pagination__page pagination__next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 5L20 12M20 12L13 19M20 12H4" stroke="#131313" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"/>
        </svg>
    </a>
    <? else:?>
    <span class="pagination-empty"></span>
    <? endif?>
</div>
<?php if ($arResult["NavRecordCount"] > $arResult["NavLastRecordShow"]) {
    $rest = ($arResult["NavRecordCount"] - $arResult["NavPageSize"] * $arResult["NavPageNomer"]);
?>
    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="btn btn--grey btn--m">Показать ещё &nbsp;<span id="cur-page"><?=($arResult["NavPageSize"] > $rest ? $rest : $arResult["NavPageSize"])?></span>&nbsp;из&nbsp; <span id="total-pages"><?=$rest?></span></a>
<?php } ?>