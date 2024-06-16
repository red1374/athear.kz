<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var $arItem array */
?>
<?php if (count($arItem['VALUES']) > 1 ) { ?>
    <div class="filter__box filter-box">
        <div class="filter__name"><?php echo $arItem['NAME']; ?></div>
        <ul class="filter-box__list">
            <?php foreach ($arItem['VALUES'] as $arValue) { ?>
                <li class="filter-box__item" data-count="<?php echo $arValue['ELEMENT_COUNT']; ?>">
                    <input
                            class="input-action"
                            type="radio"
                            id="<?php echo $arValue['CONTROL_ID']; ?>"
                            name="<?php echo $arValue['CONTROL_NAME']; ?>"
                            value="<?php echo $arValue['HTML_VALUE']; ?>"
                    <?php echo $arValue['CHECKED'] ? 'checked="checked"' : ''; ?>>
                    <label for="<?php echo $arValue['CONTROL_ID']; ?>" aria-label="<?php echo $arValue['HTML_VALUE']; ?>">
                        <span><?php echo $arValue['VALUE']; ?></span>
                        <span class="filter-box__item-count"><?php echo $arValue['ELEMENT_COUNT']; ?></span>
                    </label>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>