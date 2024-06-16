<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
    <div class="materials__wrap">
        <?php $i = 1; ?>
        <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
<!--                <pre>-->
<!--                    --><?php //print_r($arItem); ?>
<!--                </pre>-->
            <div class="materials__row">
                <div class="materials__head"><span>0<?php echo $i; ?></span><span><?php echo $arItem['NAME']; ?></span>
                </div>
                <div class="materials__content">
                    <?php if (array_key_exists(0, $arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'])) { ?>
                        <?php foreach ($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'] as $arValue) { ?>
                            <?php $format = substr($arValue['SRC'], strripos($arValue['SRC'], '.') + 1); ?>
                            <a class="materials__item" target="_blank" href="<?php echo $arValue['SRC']; ?>">
                                <img src="<?php echo SITE_TEMPLATE_PATH ?>/images/icns/pdf.svg"
                                     alt="">
                                <span class="materials__col">
                                <span class="materials__item-name"><?php echo str_replace(['.pdf', '.PDF'], '',  $arValue['ORIGINAL_NAME']); ?></span>
                                <span>(<?php echo strtoupper($format); ?>, <?php echo CFile::FormatSize($arValue['FILE_SIZE']); ?>)</span>
                            </span>
                            </a>
                        <?php } ?>
                    <?php } else { ?>
                        <?php $format = substr($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['SRC'], strripos($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['SRC'], '.') + 1); ?>
                        <a class="materials__item" target="_blank" href="<?php echo $arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['SRC']; ?>">
                            <img src="<?php echo SITE_TEMPLATE_PATH ?>/images/icns/pdf.svg"
                                 alt="">
                            <span class="materials__col">
                                <span class="materials__item-name"><?php echo str_replace(['.pdf', '.PDF'], '', $arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['ORIGINAL_NAME']); ?></span>
                                <span>(<?php echo strtoupper($format); ?>, <?php echo CFile::FormatSize($arItem['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['FILE_SIZE']); ?>)</span>
                            </span>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php $i++; ?>
        <?php } ?>
    </div>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"] && count($arResult["ITEMS"]) > 8 && $arResult["NAV_STRING"]) { ?>
    <div class="pagination">
        <?= $arResult["NAV_STRING"]; ?>
    </div>
<?php } else { ?>
    <div class="news-bottom"></div>
<?php } ?>