<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>

<section class="info-blocks">
    <div class="_container">
        <h2 class="section-title">Подходящее решение для каждого</h2>
        <div class="info-blocks__wrap">
            <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                <div class="info-block__item" style="background-image: url(<?php echo CFile::GetPath($arItem['PREVIEW_PICTURE']); ?>)">
                    <div class="info-block__name"><?php echo $arItem['NAME']; ?></div>
                    <div class="info-block__descr"><?php echo $arItem['SUBTITLE_VALUE']; ?></div>
                    <a class="btn btn--white btn--m info-block__link" href="<?php echo $arItem['LINK_VALUE']; ?>">Подробнее</a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>