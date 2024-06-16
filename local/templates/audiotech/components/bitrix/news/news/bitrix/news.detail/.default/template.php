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

global $arrFilter;
$arrFilter['ID'] = $arResult['PROPERTIES']['CATALOG_ITEMS']['VALUE'];

$dateCreate = CIBlockFormatProperties::DateFormat(
    'j M Y',
    MakeTimeStamp(
        $arResult["TIMESTAMP_X"],
        CSite::GetDateFormat()
    )
);
?>
    <section class="news-page">
        <div class="_container">
            <div class="news-page__head">
                <h1 class="title-page news-page__title">
                    <span class="title-page__text"><?=$arResult["NAME"]?></span>
                </h1>
                <div class="news-page__date"><?=$dateCreate?></div>
            </div>
            <div class="__container-2cols">
                <div class="news-page__col news-page__content">
                    <? if (!empty($arResult['RESIZED'])):?>
                        <div class="news-page__block">
                            <div class="news-page__media">
                                <img src="<?=$arResult['RESIZED']["src"]?>"
                                     alt="<?=$arResult["NAME"]?>">
                            </div>
                        </div>
                    <? endif ?>
                    <div class="news-page__block">
                        <div class="__container-s">
                            <?=$arResult["~DETAIL_TEXT"]?>
                            <? if ($arResult['PROPERTIES']['SHOW_BTN']['VALUE'] == 'Y') { ?>
                                <a class="btn btn--icn btn--red btn--m" href="#" data-target="modal-reg"
                                   style="max-width: 215px">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M8 2C8.55228 2 9 2.44772 9 3V4H15V3C15 2.44772 15.4477 2 16 2C16.5523 2 17 2.44772 17 3V4H19C19.7957 4 20.5587 4.31607 21.1213 4.87868C21.6839 5.44129 22 6.20435 22 7V19C22 19.7957 21.6839 20.5587 21.1213 21.1213C20.5587 21.6839 19.7957 22 19 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7957 2 19V7C2 6.20435 2.31607 5.44129 2.87868 4.87868C3.44129 4.31607 4.20435 4 5 4H7V3C7 2.44772 7.44772 2 8 2ZM7 6H5C4.73478 6 4.48043 6.10536 4.29289 6.29289C4.10536 6.48043 4 6.73478 4 7V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H19C19.2652 20 19.5196 19.8946 19.7071 19.7071C19.8946 19.5196 20 19.2652 20 19V7C20 6.73478 19.8946 6.48043 19.7071 6.29289C19.5196 6.10536 19.2652 6 19 6H17V7C17 7.55228 16.5523 8 16 8C15.4477 8 15 7.55228 15 7V6H9V7C9 7.55228 8.55228 8 8 8C7.44772 8 7 7.55228 7 7V6Z"
                                              fill="white"></path>
                                        <path d="M9 11C9 11.5523 8.55228 12 8 12C7.44772 12 7 11.5523 7 11C7 10.4477 7.44772 10 8 10C8.55228 10 9 10.4477 9 11Z"
                                              fill="white"></path>
                                        <path d="M9 15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15C7 14.4477 7.44772 14 8 14C8.55228 14 9 14.4477 9 15Z"
                                              fill="white"></path>
                                        <path d="M13 11C13 11.5523 12.5523 12 12 12C11.4477 12 11 11.5523 11 11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11Z"
                                              fill="white"></path>
                                        <path d="M13 15C13 15.5523 12.5523 16 12 16C11.4477 16 11 15.5523 11 15C11 14.4477 11.4477 14 12 14C12.5523 14 13 14.4477 13 15Z"
                                              fill="white"></path>
                                        <path d="M17 11C17 11.5523 16.5523 12 16 12C15.4477 12 15 11.5523 15 11C15 10.4477 15.4477 10 16 10C16.5523 10 17 10.4477 17 11Z"
                                              fill="white"></path>
                                    </svg>
                                    Записаться на приём</a>
                            <? } ?>
                        </div>
                    </div>

                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "news",
                        array(
                            "COMPONENT_TEMPLATE" => "news",
                            "IBLOCK_TYPE" => "1c_catalog",
                            "IBLOCK_ID" => "1",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "FILTER_NAME" => "arrFilter",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "SHOW_ALL_WO_SECTION" => "N",
                            "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                            "ELEMENT_SORT_FIELD" => "shows",
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
                            "DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
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
                            'SECTION_TITLE' => $arResult['PROPERTIES']['CATALOG_TITLE']['VALUE'],
                        ),
                        false
                    )?>

                    <div class="__container-s">
                        <div class="share">
                            <h4>Поделиться</h4>
                            <div class="share__social">
<?/*                                <a class="share__item"-->
<!--                                   href="http://vkontakte.ru/share.php?url=--><? //echo $_SERVER["SERVER_NAME"] . $arResult['DETAIL_PAGE_URL'] ?><!--">-->
<!--                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <g clip-path="url(#clip0_2712_25750)">-->
<!--                                            <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C10.298 22.0025 8.62369 21.5687 7.13701 20.74L6.83201 20.562L3.80001 21.454C3.63501 21.5026 3.46033 21.5083 3.29252 21.4705C3.12472 21.4327 2.96935 21.3526 2.84115 21.238C2.71294 21.1233 2.61615 20.9778 2.55995 20.8152C2.50375 20.6526 2.49 20.4784 2.52001 20.309L2.54601 20.2L3.43801 17.168C2.49497 15.6093 1.99759 13.8218 2.00001 12C2.00001 6.477 6.47701 2 12 2ZM12 4C10.5676 3.99974 9.16147 4.38406 7.92834 5.11281C6.69521 5.84157 5.68036 6.88804 4.98977 8.14294C4.29918 9.39784 3.95817 10.8151 4.00237 12.2468C4.04656 13.6785 4.47433 15.0721 5.24101 16.282C5.43901 16.594 5.52401 16.978 5.45701 17.359L5.41801 17.522L4.97701 19.023L6.47801 18.582C6.91101 18.454 7.36101 18.532 7.71801 18.759C8.76634 19.4228 9.9547 19.8336 11.1892 19.959C12.4236 20.0844 13.6703 19.921 14.8307 19.4816C15.9911 19.0422 17.0334 18.3389 17.8752 17.4273C18.717 16.5157 19.3352 15.4208 19.6809 14.2291C20.0266 13.0374 20.0904 11.7817 19.8673 10.5611C19.6441 9.34053 19.14 8.1886 18.395 7.19638C17.65 6.20415 16.6843 5.39883 15.5744 4.84408C14.4645 4.28933 13.2408 4.00036 12 4ZM9.10201 7.184C9.21272 7.13606 9.33401 7.11776 9.45394 7.13091C9.57387 7.14406 9.68831 7.1882 9.78601 7.259C10.29 7.627 10.69 8.121 11.034 8.603L11.361 9.077L11.514 9.302C11.6023 9.43108 11.6456 9.58563 11.6373 9.74179C11.629 9.89795 11.5695 10.047 11.468 10.166L11.393 10.242L10.469 10.928C10.4245 10.9602 10.3932 11.0074 10.3809 11.0609C10.3686 11.1144 10.3761 11.1706 10.402 11.219C10.612 11.599 10.983 12.166 11.409 12.592C11.836 13.018 12.429 13.414 12.835 13.647C12.923 13.697 13.029 13.681 13.101 13.616L13.139 13.571L13.74 12.656C13.8503 12.509 14.0133 12.4105 14.1947 12.381C14.3761 12.3516 14.5618 12.3935 14.713 12.498L15.256 12.877C15.796 13.262 16.315 13.676 16.726 14.201C16.8024 14.2995 16.851 14.4167 16.8667 14.5403C16.8823 14.664 16.8645 14.7896 16.815 14.904C16.419 15.828 15.416 16.615 14.374 16.577L14.215 16.567L14.024 16.549C13.988 16.5447 13.952 16.5401 13.916 16.535L13.678 16.495C12.754 16.321 11.273 15.797 9.73801 14.263C8.20401 12.728 7.68001 11.247 7.50601 10.323L7.46601 10.085L7.44101 9.877L7.42801 9.702C7.42643 9.67701 7.42509 9.65201 7.42401 9.627C7.38601 8.583 8.17701 7.58 9.10201 7.184Z" fill="#DB1F26"/>-->
<!--                                        </g>-->
<!--                                        <defs>-->
<!--                                            <clipPath id="clip0_2712_25750">-->
<!--                                                <rect width="24" height="24" fill="white"/>-->
<!--                                            </clipPath>-->
<!--                                        </defs>-->
<!--                                    </svg>-->
<!---->
<!--                                    <span>Whatsapp</span>-->
<!--                                </a>*/?>

                                <a class="share__item"
                                   href="https://t.me/share/url?url=<?=$_SERVER["SERVER_NAME"] . $arResult['DETAIL_PAGE_URL'] ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 10L11 14L17 20L21 4L3 11L7 13L9 19L12 15" stroke="#DB1F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    <span>Telegram</span>
                                </a>

                                <a class="share__item"
                                   href="http://vkontakte.ru/share.php?url=<?=$_SERVER["SERVER_NAME"] . $arResult['DETAIL_PAGE_URL'] ?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.503 7.72223C20.643 8.11159 20.1867 9.00591 19.1342 10.4052C18.9882 10.5999 18.7905 10.8584 18.541 11.1809C18.2977 11.4911 18.1304 11.7102 18.0391 11.8379C17.9479 11.9657 17.8551 12.1162 17.7608 12.2896C17.6665 12.463 17.63 12.5908 17.6513 12.6729C17.6726 12.755 17.7121 12.86 17.7699 12.9877C17.8277 13.1155 17.9266 13.2463 18.0665 13.3801C18.2064 13.514 18.3798 13.6752 18.5866 13.8638C18.611 13.876 18.6262 13.8881 18.6323 13.9003C19.4901 14.6973 20.0711 15.3695 20.3753 15.9171C20.3935 15.9475 20.4133 15.9855 20.4346 16.0312C20.4559 16.0768 20.4772 16.1574 20.4985 16.273C20.5198 16.3886 20.5182 16.492 20.4939 16.5833C20.4696 16.6745 20.3935 16.7582 20.2658 16.8342C20.138 16.9103 19.9585 16.9483 19.7274 16.9483L17.3912 16.9848C17.2452 17.0152 17.0748 17 16.8801 16.9392C16.6855 16.8783 16.5273 16.8114 16.4056 16.7384L16.2231 16.6289C16.0406 16.5011 15.8277 16.3064 15.5843 16.0448C15.341 15.7832 15.1326 15.5475 14.9592 15.3376C14.7858 15.1277 14.6003 14.9513 14.4025 14.8083C14.2048 14.6653 14.0329 14.6182 13.8869 14.6669C13.8687 14.673 13.8443 14.6836 13.8139 14.6988C13.7835 14.714 13.7318 14.7581 13.6588 14.8311C13.5858 14.9041 13.5204 14.9939 13.4626 15.1003C13.4048 15.2068 13.3531 15.365 13.3074 15.5749C13.2618 15.7848 13.242 16.0205 13.2481 16.2821C13.2481 16.3734 13.2375 16.457 13.2162 16.5331C13.1949 16.6091 13.1721 16.6654 13.1477 16.7019L13.1112 16.7475C13.0017 16.8631 12.8405 16.93 12.6276 16.9483H11.5781C11.1462 16.9726 10.7021 16.9224 10.2458 16.7977C9.7895 16.673 9.38949 16.5118 9.04576 16.3141C8.70202 16.1163 8.38871 15.9156 8.10581 15.7118C7.82292 15.508 7.60846 15.333 7.46245 15.187L7.23431 14.968C7.17347 14.9072 7.08982 14.8159 6.98336 14.6942C6.87689 14.5726 6.65939 14.2958 6.33087 13.8638C6.00235 13.4319 5.67991 12.9725 5.36355 12.4858C5.04719 11.9991 4.67456 11.3573 4.24565 10.5603C3.81675 9.76334 3.41978 8.93595 3.05475 8.07813C3.01825 7.98079 3 7.89866 3 7.83174C3 7.76482 3.00913 7.71615 3.02738 7.68573L3.06388 7.63098C3.15514 7.51538 3.32852 7.45759 3.58404 7.45759L6.08448 7.43934C6.15748 7.4515 6.22745 7.47128 6.29437 7.49865C6.36129 7.52603 6.40996 7.55189 6.44038 7.57622L6.48601 7.6036C6.58335 7.67052 6.65635 7.76786 6.70502 7.89562C6.8267 8.19981 6.96663 8.51464 7.1248 8.84013C7.28298 9.16561 7.4077 9.41352 7.49896 9.58387L7.64497 9.84851C7.8214 10.2135 7.99174 10.5299 8.156 10.7976C8.32027 11.0653 8.4678 11.2736 8.5986 11.4227C8.7294 11.5717 8.85564 11.6889 8.97732 11.774C9.09899 11.8592 9.20242 11.9018 9.28759 11.9018C9.37276 11.9018 9.45489 11.8866 9.53398 11.8562C9.54615 11.8501 9.56136 11.8349 9.57961 11.8105C9.59786 11.7862 9.63436 11.7193 9.68912 11.6098C9.74387 11.5003 9.78494 11.3573 9.81231 11.1809C9.83969 11.0044 9.86859 10.758 9.89901 10.4417C9.92943 10.1253 9.92943 9.74509 9.89901 9.30097C9.88684 9.05762 9.85946 8.83556 9.81688 8.6348C9.77429 8.43403 9.7317 8.29411 9.68912 8.21502L9.63436 8.10551C9.48227 7.89866 9.22371 7.76786 8.85868 7.71311C8.77959 7.70094 8.7948 7.62793 8.90431 7.49409C9.00165 7.3785 9.11724 7.28724 9.25109 7.22032C9.57353 7.06214 10.3005 6.98914 11.4321 7.0013C11.931 7.00739 12.3416 7.04693 12.6641 7.11994C12.7858 7.15036 12.8877 7.19142 12.9698 7.24313C13.0519 7.29485 13.1143 7.36785 13.1569 7.46215C13.1995 7.55645 13.2314 7.65379 13.2527 7.75417C13.274 7.85455 13.2846 7.99296 13.2846 8.16939C13.2846 8.34582 13.2816 8.51312 13.2755 8.6713C13.2694 8.82948 13.2618 9.04393 13.2527 9.31466C13.2436 9.58539 13.239 9.83635 13.239 10.0675C13.239 10.1345 13.236 10.2622 13.2299 10.4508C13.2238 10.6394 13.2223 10.7854 13.2253 10.8888C13.2284 10.9923 13.239 11.1155 13.2573 11.2584C13.2755 11.4014 13.3105 11.52 13.3622 11.6143C13.4139 11.7086 13.4824 11.7832 13.5675 11.8379C13.6162 11.8501 13.6679 11.8622 13.7227 11.8744C13.7774 11.8866 13.8565 11.8531 13.9599 11.774C14.0634 11.6949 14.1789 11.59 14.3067 11.4592C14.4345 11.3284 14.5926 11.1246 14.7812 10.8478C14.9698 10.571 15.1767 10.244 15.4018 9.86677C15.7668 9.23405 16.0923 8.54963 16.3782 7.81349C16.4026 7.75265 16.433 7.69942 16.4695 7.65379C16.506 7.60816 16.5395 7.57622 16.5699 7.55797L16.6064 7.53059L16.652 7.50778L16.7706 7.4804L16.9532 7.47584L19.5813 7.45759C19.8186 7.42717 20.0133 7.43477 20.1654 7.4804C20.3175 7.52603 20.4118 7.57622 20.4483 7.63098L20.503 7.72223Z"
                                              fill="#DB1F26"/>
                                    </svg>
                                    <span>Вконтакте</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-page__col email_form">
                    <div class="form_container aside-block" data-name="subscribe_aside"></div>
                </div>
            </div>
        </div>
    </section>
<? $APPLICATION->IncludeComponent(
    'coderoom:news.slider',
    '.default',
    [
        'IS_BLOG' => $arParams['IS_BLOG'],
        'TITLE' => 'Похожие статьи',
        'SHOW_LINK' => 'N',
        'ELEMENT_ID' => $arResult['ID'],
    ]
)?>
    <form class="aside-block aside-block--mobile email_form">
        <input type="hidden" name="formName" value="Подписаться на рассылку">
        <h2 class="aside-block__title">Подписаться на рассылку</h2>
        <div class="input__overlay">
            <input class="input-default" type="email" placeholder="Электронная почта">
        </div>
        <p class="aside-block__agree">Подписываясь, вы даете согласие на <a href="">обработку персональных данных</a>
        </p>
        <button class="btn btn--red btn--l btn--icn" type="submit">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z"
                      stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Подписаться</span></button>
    </form>

<? $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
)?>