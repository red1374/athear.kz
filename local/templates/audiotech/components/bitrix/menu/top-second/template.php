<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */
$this->setFrameMode(true);
?>

<?php if ($arResult) { ?>
    <div class="tabs__nav">
        <? foreach ($arResult as $arItem) { ?>
            <a href="<?= $arItem['LINK'] ?>" class="tabs__btn <? if ($arItem['SELECTED'] == 1) {
                echo 'active';
            } ?>">
                <?= $arItem['TEXT'] ?>
            </a>
        <? } ?>
    </div>
<?php } ?>