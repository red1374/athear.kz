<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>

<?php if ($arResult['ITEMS']) { ?>
    <div class="chips">
        <div class="chips__inner chips__inner--sort">
            <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                <a href="<?php echo $arItem['LINK_VALUE']; ?>" class="chips__item <?php echo $arItem['ACTIVE'] == 'Y' ? 'active' : ''; ?>"><?php echo $arItem['NAME']; ?></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>