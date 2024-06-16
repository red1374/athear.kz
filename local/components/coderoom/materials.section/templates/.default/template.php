<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>
<ul class="materials__list">
    <li>
        <label class="label" for="">Выберите бренд</label>
        <select class="mySelect" name="">
            <option value="/customer/materials/">Все</option>
            <?php foreach ($arResult['ITEMS']['FIRST_LEVEL'] as $arItem) { ?>
                <option value="<?php echo $arItem['LINK']; ?>" <?php if ($arItem['ACTIVE'] == 'Y') echo 'selected'; ?>><?php echo $arItem['NAME']; ?></option>
            <?php } ?>
        </select>
    </li>

    <?php if ($arResult['ITEMS']['SECOND_LEVEL']) { ?>
        <li>
            <label class="label" for="">Выберите модель</label>
            <select class="mySelect" name="">
                <?php foreach ($arResult['ITEMS']['FIRST_LEVEL'] as $arItem) { ?>
                    <?php if ($arItem['ACTIVE'] == 'Y') { ?>
                        <option value="<?php echo $arItem['LINK']; ?>">Все</option>
                    <?php } ?>
                <?php } ?>
                <?php foreach ($arResult['ITEMS']['SECOND_LEVEL'] as $arItem) { ?>
                    <option value="<?php echo $arItem['LINK']; ?>" <?php if ($arItem['ACTIVE'] == 'Y') echo 'selected'; ?>><?php echo $arItem['NAME']; ?></option>
                <?php } ?>
            </select>
        </li>
    <?php } ?>
</ul>