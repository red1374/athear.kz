<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

global $APPLICATION;

/**
 * @global $arResult
 */

if ($APPLICATION->GetCurPage(false) != '/catalog/aksessuary/') { ?>
    <section class="offers">
        <div class="_container">
            <div class="offers__wrap">
                <? foreach ($arResult['ITEMS'] as $arItem) { ?>
                    <div class="offers__item"><img src="<?=CFile::GetPath($arItem['IMAGE_VALUE']); ?>" alt="<?=$arItem['NAME']; ?>">
                        <div class="offers__name"><?=$arItem['NAME']; ?></div>
                        <p class="offers__text"><?=$arItem['PREVIEW_TEXT']; ?></p>
                        <!-- Если ссылка на каталог -->
                        <? if ($arItem['BTN_ACTION_VALUE'] == 2) { ?>
                            <a class="btn btn--red btn--m" href="/catalog/aksessuary/"><?=$arItem['BTN_TEXT_VALUE']; ?></a>
                        <? } else if ($arItem['BTN_ACTION_VALUE'] == 27) { ?>
                            <a class="btn btn--red btn--m" href="/customer/services/"><?=$arItem['BTN_TEXT_VALUE']; ?></a>
                        <? } else if ($arItem['BTN_ACTION_VALUE'] == 28) { ?>
                            <a class="btn btn--red btn--m" href="javascript:void();" data-action="call"><?=$arItem['BTN_TEXT_VALUE']; ?></a>
                        <? } else { ?>
                            <!-- Выбор модального окна (3 – запись, 4 – звонок) -->
                            <button class="btn btn--red btn--m" data-target="modal-reg"><?=$arItem['BTN_TEXT_VALUE']; ?></button>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>
<? }
