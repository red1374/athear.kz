<?php

use Coderoom\Main\Cart\ListCart;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;

$APPLICATION->SetTitle('Корзина');

$obCartList = new ListCart;
$arCartItems = $obCartList->getListItems();
?>

<section class="basket">
    <div class="_container">
        <h1 class="title-page">Корзина</h1>
        <div class="__inner">
            <div class="basket__wrap">
                <?php if ($arCartItems) { ?>
                    <div class="basket__head"><span>Товар</span><span></span><span>Цена/Кол-во</span><span>Сумма</span></div>
                    <div class="basket__items">
                        <?php foreach ($arCartItems as $arItem) { ?>
                            <div class="basket__item" data-price="<?php echo $arItem['PRICE']; ?>">
                                <div class="basket__item-pic">
                                    <div class="basket__head basket__head--mob"><span>Товар</span></div>
                                    <img src="<?php echo $arItem['PREVIEW_PICTURE']; ?>"
                                         alt="<?php echo $arItem['NAME']; ?>">
                                </div>
                                <div class="basket__col">
                                    <div class="basket__head basket__head--mob"><span>Товар</span></div>
                                    <a href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>" class="basket__item-name"><?php echo $arItem['NAME']; ?></a>
                                    <div class="btns-wrap">
                                        <div class="btn-icn btn-icn__favorite btn-icn__favorite--desctop <?php if ($arItem['DELAY'] == 'Y') echo 'active'; ?>"
                                             onclick="<?php echo $arItem['DELAY'] == 'Y' ? 'deleteFavorite' : 'addToFavorite'; ?>(<?php echo $arItem['PRODUCT_ID']; ?>)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M3.8065 6.20635C4.70663 5.30649 5.92731 4.80097 7.2001 4.80097C8.47289 4.80097 9.69357 5.30649 10.5937 6.20635L12.0001 7.61155L13.4065 6.20635C13.8493 5.7479 14.3789 5.38223 14.9646 5.13066C15.5502 4.8791 16.18 4.74669 16.8174 4.74115C17.4547 4.73561 18.0868 4.85706 18.6767 5.09841C19.2666 5.33975 19.8025 5.69617 20.2532 6.14685C20.7039 6.59754 21.0603 7.13347 21.3016 7.72337C21.543 8.31327 21.6644 8.94533 21.6589 9.58268C21.6534 10.22 21.5209 10.8499 21.2694 11.4355C21.0178 12.0211 20.6521 12.5508 20.1937 12.9935L12.0001 21.1883L3.8065 12.9935C2.90664 12.0934 2.40112 10.8727 2.40112 9.59995C2.40112 8.32716 2.90664 7.10648 3.8065 6.20635Z"
                                                      fill="#fff" stroke-width="2" stroke="black"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="basket__col">
                                    <div class="basket__head basket__head--mob"><span>Цена/Кол-во</span></div>
                                    <div class="basket__item-price"><?php echo number_format($arItem['PRICE'], 0, '', ' '); ?><span> ₸</span></div>
                                    <div class="counter show" data-counter>
                                        <div class="counter__btn counter__btn--minus">
                                            <svg width="18" height="2" viewBox="0 0 18 2" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17 1H9H1" stroke="#131313" stroke-width="2"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="counter__input">
                                            <input type="text" data-id="<?php echo $arItem['PRODUCT_ID']; ?>" disabled value="<?php echo number_format($arItem['QUANTITY'], 0); ?>">
                                        </div>
                                        <div class="counter__btn counter__btn--plus">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 1V9M9 17V9M9 9H17M9 9H1" stroke="#131313" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="basket__col">
                                    <div class="basket__head basket__head--mob"><span>Сумма</span></div>
                                    <div class="basket__item-price item-total"><?php echo number_format($arItem['GENERAL_PRICE'], 0, '', ' '); ?>
                                        <span> ₸</span></div>
                                    <div class="btns-wrap">
                                        <div class="btn-icn btn-icn__favorite <?php if ($arItem['DELAY'] == 'Y') echo 'active'; ?>"
                                             onclick="<?php echo $arItem['DELAY'] == 'Y' ? 'deleteFavorite' : 'addToFavorite'; ?>(<?php echo $arItem['PRODUCT_ID']; ?>)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M5.39816 4.39656C6.06517 4.12682 6.77925 3.98828 7.49984 3.98828C8.22044 3.98828 8.93452 4.12682 9.60152 4.39656C10.2686 4.66632 10.8762 5.06232 11.3892 5.56311L11.9998 6.15933L12.6105 5.56311C13.6461 4.55209 15.0456 3.98829 16.4998 3.98829C17.9541 3.98829 19.3536 4.55209 20.3892 5.56311C21.4255 6.57494 22.0124 7.95252 22.0124 9.3942C22.0124 10.8359 21.4255 12.2134 20.3892 13.2253L12.7072 20.7253C12.3138 21.1093 11.6859 21.1093 11.2925 20.7253L3.61054 13.2253C3.09754 12.7244 2.68927 12.1285 2.41027 11.4709C2.13125 10.8133 1.9873 10.1075 1.9873 9.3942C1.9873 8.68086 2.13125 7.97511 2.41027 7.31746C2.68927 6.65986 3.09753 6.06395 3.61054 5.56311C4.12348 5.06231 4.73112 4.66632 5.39816 4.39656ZM11.9998 18.5858L5.02515 11.7763C4.70242 11.4612 4.44773 11.0885 4.27443 10.68C4.10116 10.2716 4.0123 9.83477 4.0123 9.3942C4.0123 8.95362 4.10116 8.51677 4.27443 8.10836C4.44773 7.6999 4.70241 7.32716 5.02515 7.01207C5.34793 6.69693 5.73246 6.44569 6.15735 6.27386C6.58228 6.10202 7.03853 6.01328 7.49984 6.01328C7.96116 6.01328 8.41741 6.10202 8.84234 6.27386C9.26723 6.44569 9.65174 6.69692 9.97453 7.01206L11.2925 8.29884C11.6859 8.68287 12.3138 8.68287 12.7072 8.29884L14.0252 7.01207C14.6774 6.37525 15.5672 6.01329 16.4998 6.01329C17.4325 6.01329 18.3223 6.37525 18.9745 7.01207C19.626 7.64808 19.9874 8.50547 19.9874 9.3942C19.9874 10.2829 19.626 11.1403 18.9745 11.7763L11.9998 18.5858Z"
                                                      fill="#131313"/>
                                            </svg>
                                        </div>
                                        <div class="btn-icn basket__remove-item" onclick="deleteFromCart(<?php echo $arItem['PRODUCT_ID']; ?>)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                                                      fill="#131313"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <p>Товаров не найдено.</p>
                <?php } ?>
            </div>

            <?php if ($arCartItems) { ?>
                <div class="aside-box">
                    <h2 class="section-title">Ваш заказ</h2>
                    <ul class="aside-box__list">
                        <li class="aside-box__item"><span class="aside-box__text">Кол-во товаров</span><span
                                    class="aside-box__text"><?php echo $obCartList->getCount(); ?></span></li>
                        <li class="aside-box__item"><span class="aside-box__text strong">Сумма товаров</span><span
                                    class="aside-box__text strong total-price"><?php echo $obCartList->getGeneralPrice(); ?> ₸</span>
                        </li>
                    </ul>
                    <a href="/personal/order/" class="btn btn--red btn--icn btn--l">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 9V8C17.5 5.2385 15.2615 3 12.5 3C9.7385 3 7.5 5.2385 7.5 8V9H4.5C3.94772 9 3.5 9.44772 3.5 10V18C3.5 19.6575 4.8425 21 6.5 21H18.5C20.1575 21 21.5 19.6575 21.5 18V10C21.5 9.44772 21.0523 9 20.5 9H17.5ZM9.5 8C9.5 6.34325 10.8433 5 12.5 5C14.1567 5 15.5 6.34325 15.5 8V9H9.5V8ZM19.5 18C19.5 18.5525 19.0525 19 18.5 19H6.5C5.9475 19 5.5 18.5525 5.5 18V11H19.5V18Z"
                                  fill="white"/>
                        </svg>
                        Оформить заказ</a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<div class="cart-wrap">
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "popular",
        array(
            "COMPONENT_TEMPLATE" => "popular",
            "IBLOCK_TYPE" => "1c_catalog",
            "IBLOCK_ID" => "1",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "arrFilter",
            "INCLUDE_SUBSECTIONS" => "Y",
            "SHOW_ALL_WO_SECTION" => "N",
            "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:1:65\",\"DATA\":{\"logic\":\"Equal\",\"value\":26}}]}",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "ELEMENT_SORT_FIELD" => "",
            "ELEMENT_SORT_ORDER" => "desc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "PAGE_ELEMENT_COUNT" => "8",
            "LINE_ELEMENT_COUNT" => "3",
            "BACKGROUND_IMAGE" => "-",
            "TEMPLATE_THEME" => "blue",
            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
            "ENLARGE_PRODUCT" => "STRICT",
            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
            "SHOW_SLIDER" => "N",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => array(
                0 => "BREND",
                1 => "TIP_KORPUSA",
                2 => "STEPEN_POTERI_SLUKHA",
                3 => "MOSHCHNOST",
                4 => "CML2_MANUFACTURER",
                5 => "TIP_BATAREYKI",
                6 => "OSOBENNOSTI",
                7 => "BLUETOOTH",
                8 => "AKUSTICHESKIE_SITUATSII",
            ),
            "LABEL_PROP_MOBILE" => array(
                0 => "BREND",
                1 => "TIP_KORPUSA",
                2 => "STEPEN_POTERI_SLUKHA",
                3 => "MOSHCHNOST",
                4 => "CML2_MANUFACTURER",
                5 => "TIP_BATAREYKI",
                6 => "OSOBENNOSTI",
                7 => "BLUETOOTH",
                8 => "AKUSTICHESKIE_SITUATSII",
            ),
            "LABEL_PROP_POSITION" => "top-left",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "SHOW_MAX_QUANTITY" => "N",
            "SHOW_CLOSE_POPUP" => "N",
            "MESS_BTN_BUY" => "",
            "MESS_BTN_ADD_TO_BASKET" => "",
            "MESS_BTN_SUBSCRIBE" => "",
            "MESS_BTN_DETAIL" => "",
            "MESS_NOT_AVAILABLE" => "",
            "MESS_NOT_AVAILABLE_SERVICE" => "",
            "RCM_TYPE" => "personal",
            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
            "SHOW_FROM_SECTION" => "N",
            "SECTION_URL" => "",
            "DETAIL_URL" => "/product/#ELEMENT_CODE#/",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SEF_MODE" => "Y",
            "SEF_RULE" => "",
            "SECTION_ID" => $_REQUEST["SECTION_ID"],
            "SECTION_CODE" => "",
            "SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "SET_TITLE" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => "Y",
            "META_DESCRIPTION" => "-",
            "SET_LAST_MODIFIED" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "ADD_SECTIONS_CHAIN" => "Y",
            "CACHE_FILTER" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRICE_CODE" => array(
                0 => "Розничная цена",
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/cart/",
            "USE_PRODUCT_QUANTITY" => "N",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "ADD_TO_BASKET_ACTION" => "ADD",
            "DISPLAY_COMPARE" => "N",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "PAGER_TEMPLATE" => ".default",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "LAZY_LOAD" => "N",
            "MESS_BTN_LAZY_LOAD" => "Показать ещё",
            "LOAD_ON_SCROLL" => "N",
            "SET_STATUS_404" => "Y",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "COMPATIBLE_MODE" => "N",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            'TITLE' => 'Добавить к заказу',
            'HIDE_BTN' => 'Y',
            'SHOW_BUY_BTN' => 'Y'
        ),
        false
    ); ?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
