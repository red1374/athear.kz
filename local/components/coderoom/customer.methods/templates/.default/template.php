<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>
<section class="buyers">
    <div class="_container">
        <h2 class="section-title">Способы оплаты</h2>
        <div class="buyers__wrap">
            <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                <div class="item">
                    <?php $icon = unserialize($arItem['ICON_VALUE']); ?>
                    <div class="item__pic"><?php echo $icon['TEXT']; ?></div>
                    <h4 class="item__titlle"><?php echo $arItem['NAME']; ?></h4>
                    <p><?php echo $arItem['PREVIEW_TEXT']; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>