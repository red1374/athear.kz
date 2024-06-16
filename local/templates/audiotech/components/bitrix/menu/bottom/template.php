<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */
$this->setFrameMode(true);
if (!empty($arResult)) { ?>
    <div class="footer__col">
        <?php foreach ($arResult as $arItem) { ?>
            <a class="footer__link footer__title" href="<?php echo $arItem['LINK']; ?>"><?php echo $arItem['TEXT']; ?></a>
        <?php } ?>
    </div>
    <?
} ?>