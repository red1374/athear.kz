<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);
?>
<div class="catalog__inner" id="catalogAjax">
    <div class="catalog__items">
        <? if ($arResult['ITEMS']) {
            foreach ($arResult['ITEMS'] AS &$arItem) { ?>
                <div class="card">
                    <? if (!empty($arItem["RESIZED"])):?>
                    <a class="card__pic" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
                        <img src="<?=$arItem["RESIZED"]['src']?>" alt="<?=$arItem['NAME']?>">
                    </a>
                    <? endif?>
                    <span class="card__category">
                        <? foreach ($arResult['SECTIONS_NAME'] AS $itemID => &$sectionName) {
                            if ($itemID == $arItem['ID']) { ?>
                                <?=$sectionName?>
                            <? }
                            } ?>
                    </span>
                    <a class="card__name"
                           href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                    <div class="card__footer">
                    <? if ($arItem['IBLOCK_SECTION_ID'] == 2):?>
                        <div class="card__price card__price--actual"><?=$arItem['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?></div>
                        <? if ($arItem['PROPERTIES']['OLD_PRICE']['VALUE'] && $arItem['PROPERTIES']['OLD_PRICE']['VALUE'] > $arItem['ITEM_PRICES'][0]['PRICE']) { ?>
                            <div class="product-descr__old-price"><?=number_format($arItem['PROPERTIES']['OLD_PRICE']['VALUE'], 0, '', ' ')?> ₸</div>
                        <? } ?>
                    <?endif?>
                    </div>
                    <? if($arItem['PROPERTIES']['NOT_FOR_BUY']['VALUE'] != 'Y') { ?>
                        <button class="btn btn--red btn--icn btn--m" data-id="<?=$arItem['ID']?>" data-quantity="1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 9V8C17 5.2385 14.7615 3 12 3C9.2385 3 7 5.2385 7 8V9H4C3.44772 9 3 9.44772 3 10V18C3 19.6575 4.3425 21 6 21H18C19.6575 21 21 19.6575 21 18V10C21 9.44772 20.5523 9 20 9H17ZM9 8C9 6.34325 10.3433 5 12 5C13.6567 5 15 6.34325 15 8V9H9V8ZM19 18C19 18.5525 18.5525 19 18 19H6C5.4475 19 5 18.5525 5 18V11H19V18Z"
                                      fill="white"/>
                            </svg>
                            В корзину
                        </button>
                    <? } ?>
                </div>
            <? }
        } else { ?>
            <p>Элементов не найдено.</p>
        <? } ?>
    </div>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]) { ?>
        <div class="pagination">
            <?= $arResult["NAV_STRING"]?>
        </div>
    <? } else { ?>
        <div class="news-bottom" style="border-top: 1px solid #E8EBED;"></div>
    <? } ?>
</div>
<? $this->SetViewTarget('DESCRIPTION');
if ($arResult['DESCRIPTION']):?>
<div class="text-block__text"><?=$arResult['DESCRIPTION']?></div>
<? endif;
$this->EndViewTarget('DESCRIPTION');?>
