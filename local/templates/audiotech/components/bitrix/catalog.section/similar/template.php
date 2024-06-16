<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);
?>
<?php if ($arResult['ITEMS']) { ?>
    <section class="slider-block">
        <div class="_container">
            <h2 class="section-title"><span>Похожие товары</span>
                <a href="/catalog/" class="btn btn--grey btn--m">Смотреть все</a>
            </h2>
            <div class="slider-block__wrap swiper popular-slider pr30">
                <div class="swiper-wrapper">

                    <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                        <div class="swiper-slide">
                            <div class="card">
                                <a class="card__pic" href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>">
                                    <img src="<?php echo $arItem['PREVIEW_PICTURE'] ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/images/no-photo.png'; ?>" alt="<?php echo $arItem['NAME']; ?>">
                                </a>
                                <span class="card__category">
                                <?php foreach ($arResult['SECTIONS_NAME'] as $itemID => $sectionName) { ?>
                                    <?php if ($itemID == $arItem['ID']) { ?>
                                        <?php echo $sectionName; ?>
                                    <?php } ?>
                                <?php } ?>
                            </span><a class="card__name" href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>"><?php echo $arItem['NAME']; ?></a>
                                <div class="card__footer">
                                <? if ($arItem['IBLOCK_SECTION_ID'] == 2):?>
                                    <div class="card__price card__price--actual"><?php echo $arItem['ITEM_PRICES'][0]['PRINT_BASE_PRICE']; ?></div>
                                    <?php if ($arItem['PROPERTIES']['OLD_PRICE']['VALUE'] && $arItem['PROPERTIES']['OLD_PRICE']['VALUE'] > $arItem['ITEM_PRICES'][0]['PRICE']) { ?>
                                        <div class="product-descr__old-price"><?php echo number_format($arItem['PROPERTIES']['OLD_PRICE']['VALUE'], 0, '', ' '); ?> ₸</div>
                                    <?php } ?>
                                <? endif?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-navigation">
                    <div class="swiper-button-prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 5L4 12M4 12L11 19M4 12H20" stroke="#131313" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="swiper-button-next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 5L20 12M20 12L13 19M20 12H4" stroke="#131313" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
