<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>
<section class="payments">
    <div class="_container">
        <h1 class="title-page"><?php $APPLICATION->ShowTitle(false); ?></h1>
    </div>
    <div class="steps">
        <div class="_container">
            <h2 class="steps__title"> Покупка слухового аппарата</h2>
            <ul class="steps__list">
                <?php $i = 1; ?>
                <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                    <li class="steps__item"><span class="steps__number"><?php echo $i; ?></span><span class="steps__name"><?php echo $arItem['NAME']; ?></span>
                        <p class="steps__text"><?php echo $arItem['PREVIEW_TEXT']; ?></p>
                    </li>
                    <?php $i++; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>