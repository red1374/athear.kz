<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */
$this->setFrameMode(true);
?>

<div class="chips">
    <div class="chips__inner">
        <?php foreach ($arResult as $arItem) { ?>
            <a href="<?=$arItem['LINK']?>" class="chips__item <?php echo $arItem['SELECTED'] ? 'active' : ''; ?>">
                <?=$arItem['TEXT']; ?>
            </a>
        <?php } ?>
    </div>
</div>