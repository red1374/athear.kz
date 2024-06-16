<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

    $this->setFrameMode(true);
    /**
     * @global $arResult
     */
?>

<div class="chips">
    <div class="_container">
        <div class="chips__inner">
            <? foreach ($arResult['ITEMS']['SECTIONS'] AS &$arSection) { ?>
                <button data-section="<?=$arSection['ID']; ?>" class="chips__item"><?=$arSection['NAME']; ?></button>
            <? } ?>
        </div>
    </div>
</div>
<div class="_container">
    <div class="__container-2cols">
        <? foreach ($arResult['ITEMS']['SECTIONS'] AS &$arSection) { ?>
            <div data-section="<?=$arSection['ID']; ?>" class="accordion">
                <? $i = 1; ?>
                <? foreach ($arResult['ITEMS']['ELEMENTS'] as $arItem) { ?>
                    <? if ($arItem['IBLOCK_SECTION_ID'] == $arSection['ID']) { ?>
                        <div class="accordion__item">
                            <div class="accordion__header"> <span>0<?=$i; ?></span><span><?=$arItem['NAME']; ?></span></div>
                            <div class="accordion__body">
                                <div class="accordion__content">
                                    <p><?=$arItem['PREVIEW_TEXT']; ?></p>
                                </div>
                            </div>
                        </div>
                        <? $i++; ?>
                    <? } ?>
                <? } ?>
            </div>
        <? } ?>

        <div class="aside-block aside-block--questions form_container" data-name="question"></div>
    </div>
</div>