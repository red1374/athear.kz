<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>
<section class="brends">
    <div class="_container">
        <h2 class="section-title brends__title">Надёжные устройства <br>от ведущих мировых брендов </h2>
        <div class="brends__wrap">
           <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
               <div class="brends__item"><img src="<?php echo CFile::GetPath($arItem['PREVIEW_PICTURE']); ?>" alt="<?php echo $arItem['NAME']; ?>"></div>
            <?php } ?>
        </div>
    </div>
</section>