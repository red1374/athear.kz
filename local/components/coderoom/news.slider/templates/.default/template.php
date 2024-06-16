<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

    $this->setFrameMode(true);

    /**
     * @global $arResult
     * @global $arParams
     */
?>
<section class="slider-block">
    <div class="_container p0">
        <h2 class="section-title">
            <span><?=$arParams['TITLE']?></span>
            <? if ($arParams['SHOW_LINK'] == 'Y') { ?>
                <a href="<?=$arParams['IS_BLOG'] == 'Y' ? '/customer/blog/' : '/about/news/'?>" class="btn btn--grey btn--m">Всё о слухе</a>
            <? } ?>
        </h2>
        <div class="slider-block__wrap swiper blog-slider pb0">
            <div class="swiper-wrapper">
                <? foreach ($arResult["ITEMS"] AS &$arItem) {
                    $link = ($arParams['IS_BLOG'] == 'Y' ? '/customer/blog/' : '/about/news/').
                            $arItem["SECTION_CODE"]."/".$arItem["CODE"]."/";
                ?>
                    <div class="swiper-slide">
                        <div class="article-preview">
                            <? if (!empty($arItem['RESIZED'])):?>
                            <a class="article-preview__pic" title="<?=$arItem["NAME"]?>"
                               href="<?=$link?>">
                                <img src="<?=$arItem["RESIZED"]['src']?>" alt="<?=$arItem["NAME"]?>">
                            </a><?
                            endif?>
                            <div class="article-preview__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
                            <a class="article-preview__name" href="<?=$link?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a>
                            <? if (!empty($arItem["PREVIEW_TEXT"])):?>
                            <p class="article-preview__text"><?=$arItem["PREVIEW_TEXT"]?></p>
                            <? endif?>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</section>