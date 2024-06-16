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

<div class="favorite-cards">
    <?php if ($arResult['ITEMS']) { ?>
        <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
            <div class="card">
                <div class="close-white close-white--l" onclick="deleteFavorite(<?php echo $arItem['ID']; ?>)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                              fill="#131313"/>
                    </svg>
                </div>
                <a class="card__pic" href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>">
                    <img src="<?php echo $arItem['PREVIEW_PICTURE'] ? $arItem['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH . '/images/no-photo.png'; ?>"
                         alt="<?php echo $arItem['NAME']; ?>">
                </a>
                <span class="card__category">
                        <?php foreach ($arResult['SECTIONS_NAME'] as $itemID => $sectionName) { ?>
                            <?php if ($itemID == $arItem['ID']) { ?>
                                <?php echo $sectionName; ?>
                            <?php } ?>
                        <?php } ?>
                    </span>
                <a class="card__name"
                   href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>"><?php echo $arItem['NAME']; ?></a>
                <div class="card__footer">
                <? if ($arItem['IBLOCK_SECTION_ID'] == 2):?>
                    <div class="card__price card__price--actual"><?php echo $arItem['ITEM_PRICES'][0]['PRINT_BASE_PRICE']; ?></div>
                    <?php if ($arItem['PROPERTIES']['OLD_PRICE']['VALUE'] && $arItem['PROPERTIES']['OLD_PRICE']['VALUE'] > $arItem['ITEM_PRICES'][0]['PRICE']) { ?>
                        <div class="product-descr__old-price"><?php echo number_format($arItem['PROPERTIES']['OLD_PRICE']['VALUE'], 0, '', ' '); ?>
                            ₸
                        </div>
                    <?php } ?>
                <? endif?>
                </div>
                <?php if($arItem['PROPERTIES']['NOT_FOR_BUY']['VALUE'] != 'Y') { ?>
                    <button class="btn btn--red btn--icn btn--m" data-id="<?php echo $arItem['ID']; ?>" data-quantity="1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 9V8C17 5.2385 14.7615 3 12 3C9.2385 3 7 5.2385 7 8V9H4C3.44772 9 3 9.44772 3 10V18C3 19.6575 4.3425 21 6 21H18C19.6575 21 21 19.6575 21 18V10C21 9.44772 20.5523 9 20 9H17ZM9 8C9 6.34325 10.3433 5 12 5C13.6567 5 15 6.34325 15 8V9H9V8ZM19 18C19 18.5525 18.5525 19 18 19H6C5.4475 19 5 18.5525 5 18V11H19V18Z"
                                  fill="white"/>
                        </svg>
                        В корзину
                    </button>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Элементов не найдено.</p>
    <?php } ?>
</div>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"] && count($arResult["ITEMS"]) > 7) { ?>
    <div class="pagination" style="margin-top: 40px;">
        <?= $arResult["NAV_STRING"]; ?>
    </div>
<?php } ?>
