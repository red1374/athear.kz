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
 * @var string $templateFolder
 */

$this->setFrameMode(true);
?>
    <section class="product">
        <div class="_container">
            <div class="product-title-wrap">
                <h1 class="title-page product__title"><?=$APPLICATION->ShowTitle(false)?></h1>
                <button class="btn btn--grey btn--m btn--icn btn-favorite product__btn-favorite <? if ($arResult['IS_FAVORITE_ITEM'] == 'Y') echo 'active'?>"
                        onclick="<?=$arResult['IS_FAVORITE_ITEM'] == 'Y' ? 'deleteFavorite' : 'addToFavorite'?>(<?=$arResult['ID']?>)"
                        data-id="<?=$arResult['ID']?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M3.80625 6.2064C4.70639 5.30653 5.92707 4.80102 7.19985 4.80102C8.47264 4.80102 9.69332 5.30653 10.5935 6.2064L11.9999 7.6116L13.4063 6.2064C13.849 5.74795 14.3787 5.38227 14.9643 5.13071C15.5499 4.87915 16.1798 4.74673 16.8171 4.74119C17.4545 4.73566 18.0865 4.8571 18.6764 5.09845C19.2663 5.3398 19.8023 5.69621 20.253 6.1469C20.7036 6.59758 21.0601 7.13351 21.3014 7.72342C21.5427 8.31332 21.6642 8.94538 21.6587 9.58272C21.6531 10.2201 21.5207 10.8499 21.2691 11.4355C21.0176 12.0212 20.6519 12.5508 20.1935 12.9936L11.9999 21.1884L3.80625 12.9936C2.90639 12.0935 2.40088 10.8728 2.40088 9.6C2.40088 8.32721 2.90639 7.10653 3.80625 6.2064Z"
                              stroke-width="2px" stroke="#131313" fill="#F5F7FA"/>
                    </svg>
                    <span><?=$arResult['IS_FAVORITE_ITEM'] == 'Y' ? 'Добавлено в избранное' : 'Добавить в избранное'?></span>
                </button>
            </div>
            <span class="product__article">Артикул: <?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></span>
            <div class="product__wrap">
                <div class="product__main">
                    <div class="product__slider">
                        <div class="swiper-thumbs">
                            <div class="swiper-wrapper">
                                <? if (!empty($arResult['SLIDER'])) { ?>
                                    <? foreach ($arResult['SLIDER'] AS &$arSlide) { ?>
                                        <div class="swiper-slide">
                                            <img src="<?=$arSlide['THUMB']['src']?>"
                                                alt="<?=$arResult['NAME']?>">
                                        </div>
                                    <? } ?>
                                <? } else { ?>
                                    <div class="swiper-slide"><img
                                                src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.png"
                                                alt="<?=$arResult['NAME']?>"></div>
                                <? } ?>

                                <? if ($arResult['PROPERTIES']['VIDEO']['VALUE']) { ?>
                                    <div class="swiper-slide swiper-slide__video"><img
                                            src="<?=$arResult['SLIDER'][0]['THUMB']['src']?>"
                                            alt="<?=$arResult['NAME']?>">
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="swiper-product__wrap">
                            <div class="swiper-product" thumbsSlider>
                                <div class="swiper-wrapper">
                                    <? if (!empty($arResult['SLIDER'])) { ?>
                                        <? foreach ($arResult['SLIDER'] AS &$arSlide) { ?>
                                            <div class="swiper-slide">
                                                <div class="product__preview">
                                                    <img src="<?=$arSlide['MAIN']['src']?>"
                                                        alt="<?=$arResult['NAME']?>"></div>
                                                <div class="product__zom"><img
                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-zoom.svg"
                                                    alt="<?=$arResult['NAME']?>">
                                                </div>
                                            </div>
                                        <? } ?>
                                    <? } else { ?>
                                        <div class="swiper-slide">
                                            <div class="product__preview"><img
                                                        src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.png"
                                                        alt="<?=$arResult['NAME']?>"></div>
                                            <div class="product__zom"><img
                                                        src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-zoom.svg"
                                                        alt="<?=$arResult['NAME']?>"></div>
                                        </div>
                                    <? } ?>

                                    <? if ($arResult['PROPERTIES']['VIDEO']['VALUE']) { ?>
                                        <div class="swiper-slide swiper-slide__video">
                                            <div class="product__preview">
                                                <div class="play-video"><img
                                                            src="<?=$arResult['SLIDER'][0]['MAIN']['src']?>"
                                                            alt="<?=$arResult['NAME']?>">
                                                    <button class="btn-play"></button>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="product__footer">
                                <div class="product__info-text">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect width="40" height="40" rx="10" fill="#DB1F26" fill-opacity="0.05"/>
                                        <path d="M20 16V20V16ZM20 24H20.01H20ZM29 20C29 21.1819 28.7672 22.3522 28.3149 23.4442C27.8626 24.5361 27.1997 25.5282 26.364 26.364C25.5282 27.1997 24.5361 27.8626 23.4442 28.3149C22.3522 28.7672 21.1819 29 20 29C18.8181 29 17.6478 28.7672 16.5558 28.3149C15.4639 27.8626 14.4718 27.1997 13.636 26.364C12.8003 25.5282 12.1374 24.5361 11.6851 23.4442C11.2328 22.3522 11 21.1819 11 20C11 17.6131 11.9482 15.3239 13.636 13.636C15.3239 11.9482 17.6131 11 20 11C22.3869 11 24.6761 11.9482 26.364 13.636C28.0518 15.3239 29 17.6131 29 20Z"
                                              stroke="#DB1F26" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                    Бесплатная диагностика, подбор и настройка
                                </div>
                                <button class="btn btn--grey btn--m btn--icn btn-favorite product__btn-favorite product__btn-favorite--mob <? if ($arResult['IS_FAVORITE_ITEM'] == 'Y') echo 'active'?>"
                                        onclick="<?=$arResult['IS_FAVORITE_ITEM'] == 'Y' ? 'deleteFavorite' : 'addToFavorite'?>(<?=$arResult['ID']?>)"
                                        data-id="<?=$arResult['ID']?>">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M5.39816 4.39574C6.06517 4.126 6.77925 3.98746 7.49984 3.98746C8.22044 3.98746 8.93452 4.126 9.60152 4.39574C10.2686 4.66549 10.8762 5.06149 11.3892 5.56229L11.9998 6.15851L12.6105 5.56229C13.6461 4.55126 15.0456 3.98747 16.4998 3.98747C17.9541 3.98747 19.3536 4.55126 20.3892 5.56229C21.4255 6.57412 22.0124 7.9517 22.0124 9.39337C22.0124 10.835 21.4255 12.2126 20.3892 13.2245L12.7072 20.7244C12.3138 21.1085 11.6859 21.1085 11.2925 20.7244L3.61054 13.2245C3.09754 12.7236 2.68927 12.1277 2.41027 11.4701C2.13125 10.8125 1.9873 10.1067 1.9873 9.39337C1.9873 8.68004 2.13125 7.97429 2.41027 7.31663C2.68927 6.65903 3.09753 6.06313 3.61054 5.56228C4.12348 5.06149 4.73112 4.66549 5.39816 4.39574ZM11.9998 18.5849L5.02515 11.7755C4.70242 11.4604 4.44773 11.0877 4.27443 10.6792C4.10116 10.2708 4.0123 9.83394 4.0123 9.39337C4.0123 8.9528 4.10116 8.51595 4.27443 8.10754C4.44773 7.69908 4.70241 7.32633 5.02515 7.01125C5.34793 6.69611 5.73246 6.44487 6.15735 6.27304C6.58228 6.1012 7.03853 6.01246 7.49984 6.01246C7.96116 6.01246 8.41741 6.1012 8.84234 6.27304C9.26723 6.44487 9.65174 6.6961 9.97453 7.01124L11.2925 8.29802C11.6859 8.68205 12.3138 8.68205 12.7072 8.29802L14.0252 7.01124C14.6774 6.37442 15.5672 6.01247 16.4998 6.01247C17.4325 6.01247 18.3223 6.37442 18.9745 7.01124C19.626 7.64726 19.9874 8.50464 19.9874 9.39337C19.9874 10.2821 19.626 11.1395 18.9745 11.7755L11.9998 18.5849Z"
                                              fill="#131313"/>
                                    </svg>
                                    <span><?=$arResult['IS_FAVORITE_ITEM'] == 'Y' ? 'Добавлено в избранное' : 'Добавить в избранное'?></span></button>
                            </div>
                        </div>
                    </div>

                    <div class="product__slider2">
                        <button class="close-white close-white--l" id="close-product-pic">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                                      fill="#131313"/>
                            </svg>
                        </button>
                        <div class="swiper-thumbs">
                            <div class="swiper-wrapper">
                                <? if (!empty($arResult['SLIDER'])) {
                                     foreach ($arResult['SLIDER'] AS &$arSlide) { ?>
                                        <div class="swiper-slide">
                                            <img src="<?=$arSlide['THUMB']['src']?>"
                                                alt="<?=$arResult['NAME']?>">
                                        </div>
                                    <? }
                                } else { ?>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.png"
                                                alt="<?=$arResult['NAME']?>">
                                </div>
                            <? }
                            if ($arResult['PROPERTIES']['VIDEO']['VALUE']) { ?>
                                <div class="swiper-slide swiper-slide__video">
                                    <img src="<?=$arResult['SLIDER'][0]['THUMB']['src']?>"
                                        alt="<?=$arResult['NAME']?>">
                                </div>
                            <? } ?>
                            </div>
                        </div>
                        <div class="swiper-product" thumbsSlider>
                            <div class="swiper-wrapper">
                                <? if (!empty($arResult['SLIDER'])) {
                                    foreach ($arResult['SLIDER'] AS &$arSlide) { ?>
                                        <div class="swiper-slide">
                                            <div class="product__preview">
                                                <img src="<?=$arSlide['BIG']['src']?>"
                                                    alt="<?=$arResult['NAME']?>">
                                            </div>
                                        </div>
                                    <? }
                                } else { ?>
                                    <div class="swiper-slide">
                                        <div class="product__preview"><img
                                                    src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.png"
                                                    alt="<?=$arResult['NAME']?>"></div>
                                    </div>
                                <? }
                                if ($arResult['PROPERTIES']['VIDEO']['VALUE']) { ?>
                                    <div class="swiper-slide swiper-slide__video">
                                        <div class="product__preview">
                                            <div class="play-video"><img
                                                    src="<?=$arResult['SLIDER'][0]['BIG']['src']?>"
                                                    alt="<?=$arResult['NAME']?>">
                                                <button class="btn-play"></button>
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <? if ($arResult['PROPERTIES']['VIDEO']['VALUE']) { ?>
                        <div class="video-wrap">
                            <iframe id="video" width="1024" height="768"
                                    src="<?=$arResult['PROPERTIES']['VIDEO']['VALUE']?>"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            <button class="video-wrap__close stop-video"></button>
                        </div>
                    <? } ?>

                </div>
                <div class="product__descr product-descr">
                    <? if ($arResult['IBLOCK_SECTION_ID'] == 2):?>
                    <div class="product-descr__price">
                        <div class="product-descr__new-price"><?=$arResult['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?>
                            <? if ($arResult['SECTION']['PATH'][0]['ID'] == 15) { ?>
                                <button class="product-descr__inf" id="tip">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M21.5999 11.9999C21.5999 14.546 20.5885 16.9878 18.7881 18.7881C16.9878 20.5885 14.546 21.5999 11.9999 21.5999C9.45382 21.5999 7.01203 20.5885 5.21168 18.7881C3.41133 16.9878 2.3999 14.546 2.3999 11.9999C2.3999 9.45382 3.41133 7.01203 5.21168 5.21168C7.01203 3.41133 9.45382 2.3999 11.9999 2.3999C14.546 2.3999 16.9878 3.41133 18.7881 5.21168C20.5885 7.01203 21.5999 9.45382 21.5999 11.9999ZM11.9999 8.3999C11.7891 8.3997 11.5819 8.45505 11.3992 8.56038C11.2166 8.66571 11.0649 8.81731 10.9595 8.9999C10.8834 9.14135 10.7796 9.26608 10.6544 9.36669C10.5292 9.46731 10.385 9.54175 10.2305 9.58562C10.076 9.62949 9.91424 9.64189 9.75483 9.62209C9.59542 9.60228 9.44161 9.55067 9.30252 9.47032C9.16343 9.38996 9.04189 9.2825 8.9451 9.1543C8.84831 9.02611 8.77825 8.87978 8.73906 8.724C8.69987 8.56822 8.69235 8.40616 8.71696 8.24743C8.74157 8.08869 8.79779 7.93651 8.8823 7.7999C9.27856 7.11364 9.89019 6.5773 10.6223 6.27406C11.3545 5.97082 12.1662 5.91763 12.9317 6.12273C13.6971 6.32784 14.3735 6.77978 14.8559 7.40846C15.3384 8.03715 15.5999 8.80745 15.5999 9.5999C15.6001 10.3446 15.3694 11.0711 14.9396 11.6793C14.5098 12.2875 13.902 12.7475 13.1999 12.9959V13.1999C13.1999 13.5182 13.0735 13.8234 12.8484 14.0484C12.6234 14.2735 12.3182 14.3999 11.9999 14.3999C11.6816 14.3999 11.3764 14.2735 11.1514 14.0484C10.9263 13.8234 10.7999 13.5182 10.7999 13.1999V11.9999C10.7999 11.6816 10.9263 11.3764 11.1514 11.1514C11.3764 10.9263 11.6816 10.7999 11.9999 10.7999C12.3182 10.7999 12.6234 10.6735 12.8484 10.4484C13.0735 10.2234 13.1999 9.91816 13.1999 9.5999C13.1999 9.28164 13.0735 8.97642 12.8484 8.75137C12.6234 8.52633 12.3182 8.3999 11.9999 8.3999ZM11.9999 17.9999C12.3182 17.9999 12.6234 17.8735 12.8484 17.6484C13.0735 17.4234 13.1999 17.1182 13.1999 16.7999C13.1999 16.4816 13.0735 16.1764 12.8484 15.9514C12.6234 15.7263 12.3182 15.5999 11.9999 15.5999C11.6816 15.5999 11.3764 15.7263 11.1514 15.9514C10.9263 16.1764 10.7999 16.4816 10.7999 16.7999C10.7999 17.1182 10.9263 17.4234 11.1514 17.6484C11.3764 17.8735 11.6816 17.9999 11.9999 17.9999Z"
                                              fill="#CCCCCC"/>
                                    </svg>
                                </button>
                            <? } ?>
                        </div>
                        <? if ($arResult['PROPERTIES']['OLD_PRICE']['VALUE'] && $arResult['PROPERTIES']['OLD_PRICE']['VALUE'] > $arResult['ITEM_PRICES'][0]['PRICE']) { ?>
                            <div class="product-descr__old-price"><?=number_format($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], 0, '', ' ')?>
                                ₸
                            </div>
                        <? } ?>
                    </div>
                    <?
                    endif;
                    if ($arResult['PROPERTIES']['NOT_FOR_BUY']['VALUE'] == 'Y') { ?>
                        <div class="producr-descr__btns">
                            <button class="btn btn--red btn--icn btn--l" data-target="modal-reg">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M8.5 2C9.05228 2 9.5 2.44772 9.5 3V4H15.5V3C15.5 2.44772 15.9477 2 16.5 2C17.0523 2 17.5 2.44772 17.5 3V4H19.5C20.2957 4 21.0587 4.31607 21.6213 4.87868C22.1839 5.44129 22.5 6.20435 22.5 7V19C22.5 19.7957 22.1839 20.5587 21.6213 21.1213C21.0587 21.6839 20.2957 22 19.5 22H5.5C4.70435 22 3.94129 21.6839 3.37868 21.1213C2.81607 20.5587 2.5 19.7957 2.5 19V7C2.5 6.20435 2.81607 5.44129 3.37868 4.87868C3.94129 4.31607 4.70435 4 5.5 4H7.5V3C7.5 2.44772 7.94772 2 8.5 2ZM7.5 6H5.5C5.23478 6 4.98043 6.10536 4.79289 6.29289C4.60536 6.48043 4.5 6.73478 4.5 7V19C4.5 19.2652 4.60536 19.5196 4.79289 19.7071C4.98043 19.8946 5.23478 20 5.5 20H19.5C19.7652 20 20.0196 19.8946 20.2071 19.7071C20.3946 19.5196 20.5 19.2652 20.5 19V7C20.5 6.73478 20.3946 6.48043 20.2071 6.29289C20.0196 6.10536 19.7652 6 19.5 6H17.5V7C17.5 7.55228 17.0523 8 16.5 8C15.9477 8 15.5 7.55228 15.5 7V6H9.5V7C9.5 7.55228 9.05228 8 8.5 8C7.94772 8 7.5 7.55228 7.5 7V6Z"
                                          fill="white"/>
                                    <path d="M9.5 11C9.5 11.5523 9.05228 12 8.5 12C7.94772 12 7.5 11.5523 7.5 11C7.5 10.4477 7.94772 10 8.5 10C9.05228 10 9.5 10.4477 9.5 11Z"
                                          fill="white"/>
                                    <path d="M9.5 15C9.5 15.5523 9.05228 16 8.5 16C7.94772 16 7.5 15.5523 7.5 15C7.5 14.4477 7.94772 14 8.5 14C9.05228 14 9.5 14.4477 9.5 15Z"
                                          fill="white"/>
                                    <path d="M13.5 11C13.5 11.5523 13.0523 12 12.5 12C11.9477 12 11.5 11.5523 11.5 11C11.5 10.4477 11.9477 10 12.5 10C13.0523 10 13.5 10.4477 13.5 11Z"
                                          fill="white"/>
                                    <path d="M13.5 15C13.5 15.5523 13.0523 16 12.5 16C11.9477 16 11.5 15.5523 11.5 15C11.5 14.4477 11.9477 14 12.5 14C13.0523 14 13.5 14.4477 13.5 15Z"
                                          fill="white"/>
                                    <path d="M17.5 11C17.5 11.5523 17.0523 12 16.5 12C15.9477 12 15.5 11.5523 15.5 11C15.5 10.4477 15.9477 10 16.5 10C17.0523 10 17.5 10.4477 17.5 11Z"
                                          fill="white"/>
                                </svg>
                                Записаться на приём
                            </button>
                            <a href="/centers/" class="btn btn--grey btn--l btn--icn btn--search">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M10.5 4C8.9087 4 7.38258 4.63214 6.25736 5.75736C5.13214 6.88258 4.5 8.4087 4.5 10C4.5 10.7879 4.65519 11.5681 4.95672 12.2961C5.25825 13.0241 5.70021 13.6855 6.25736 14.2426C6.81451 14.7998 7.47595 15.2417 8.2039 15.5433C8.93185 15.8448 9.71207 16 10.5 16C11.2879 16 12.0681 15.8448 12.7961 15.5433C13.5241 15.2417 14.1855 14.7998 14.7426 14.2426C15.2998 13.6855 15.7417 13.0241 16.0433 12.2961C16.3448 11.5681 16.5 10.7879 16.5 10C16.5 8.4087 15.8679 6.88258 14.7426 5.75736C13.6174 4.63214 12.0913 4 10.5 4ZM4.84315 4.34315C6.34344 2.84285 8.37827 2 10.5 2C12.6217 2 14.6566 2.84285 16.1569 4.34315C17.6571 5.84344 18.5 7.87827 18.5 10C18.5 11.0506 18.2931 12.0909 17.891 13.0615C17.6172 13.7226 17.2565 14.3425 16.8196 14.9054L22.2071 20.2929C22.5976 20.6834 22.5976 21.3166 22.2071 21.7071C21.8166 22.0976 21.1834 22.0976 20.7929 21.7071L15.4054 16.3196C14.8425 16.7565 14.2226 17.1172 13.5615 17.391C12.5909 17.7931 11.5506 18 10.5 18C9.44943 18 8.40914 17.7931 7.43853 17.391C6.46793 16.989 5.58601 16.3997 4.84315 15.6569C4.10028 14.914 3.511 14.0321 3.10896 13.0615C2.70693 12.0909 2.5 11.0506 2.5 10C2.5 7.87827 3.34285 5.84344 4.84315 4.34315Z"
                                          fill="#131313"/>
                                </svg>
                                Найти клинику
                            </a>
                        </div>
                    <? } else { ?>
                        <? if ($arResult['IS_CART_ITEM'] !== 'Y') { ?>
                            <button class="btn btn--red btn--icn btn--l addInBasket"
                                    data-id="<?=$arResult['ID']?>" data-quantity="1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 9V8C17 5.2385 14.7615 3 12 3C9.2385 3 7 5.2385 7 8V9H4C3.44772 9 3 9.44772 3 10V18C3 19.6575 4.3425 21 6 21H18C19.6575 21 21 19.6575 21 18V10C21 9.44772 20.5523 9 20 9H17ZM9 8C9 6.34325 10.3433 5 12 5C13.6567 5 15 6.34325 15 8V9H9V8ZM19 18C19 18.5525 18.5525 19 18 19H6C5.4475 19 5 18.5525 5 18V11H19V18Z"
                                          fill="white"/>
                                </svg>
                                Добавить в корзину
                            </button>
                            <div class="counter" data-counter>
                                <div class="counter__btn counter__btn--minus">
                                    <img src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-minus.svg"
                                         alt="увеличить количество товара"></div>
                                <div class="counter__input counter__input--product">
                                    <input data-id="<?=$arResult['ID']?>" type="text" disabled value="1">
                                </div>
                                <div class="counter__btn counter__btn--plus"><img
                                            src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-plus.svg"
                                            alt="уменьшить количество товара"></div>
                            </div>
                        <? } else { ?>
                            <div class="counter" data-counter style="display: flex;">
                                <div class="counter__btn counter__btn--minus">
                                    <img src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-minus.svg"
                                         alt="увеличить количество товара"></div>
                                <div class="counter__input counter__input--product">
                                    <input data-id="<?=$arResult['ID']?>" type="text" disabled
                                           value="<?=$arResult['CART_QUANTITY']?>">
                                </div>
                                <div class="counter__btn counter__btn--plus"><img
                                            src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-plus.svg"
                                            alt="уменьшить количество товара"></div>
                            </div>
                        <? } ?>
                    <? } ?>

                    <div class="product-descr__text">
                        <?=$arResult['PREVIEW_TEXT']?>
                        <?=!empty($arResult['PROPERTIES']['SHORT_DESCR']['VALUE']['TEXT']) ? html_entity_decode($arResult['PROPERTIES']['SHORT_DESCR']['VALUE']['TEXT']) : ''?>
                    </div>
                </div>
            </div>
        </div>

        <div class="advantages">
            <div class="_container">
                <ul class="advantages__list">
                    <li class="advantages__item">
                        <div class="advantages__pic">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12L11 14L15 9.99997M20.618 5.98397C17.4561 6.15189 14.3567 5.05858 12 2.94397C9.64327 5.05858 6.5439 6.15189 3.382 5.98397C3.12754 6.96908 2.99918 7.98252 3 8.99997C3 14.591 6.824 19.29 12 20.622C17.176 19.29 21 14.592 21 8.99997C21 7.95797 20.867 6.94797 20.618 5.98397Z"
                                      stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div><? $APPLICATION->IncludeFile("/include/service-item-1.php", [], ["MODE" => "html"])?>
                    </li>
                    <li class="advantages__item">
                        <div class="advantages__pic">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21 6C21 6.55228 20.5523 7 20 7L10.8284 7C10.6807 7.4179 10.4407 7.80192 10.1213 8.12132C9.55871 8.68393 8.79565 9 8 9C7.20435 9 6.44129 8.68393 5.87868 8.12132C5.55928 7.80192 5.31933 7.4179 5.17157 7H4C3.44772 7 3 6.55228 3 6C3 5.44772 3.44772 5 4 5H5.17157C5.31933 4.5821 5.55928 4.19808 5.87868 3.87868C6.44129 3.31607 7.20435 3 8 3C8.79565 3 9.55871 3.31607 10.1213 3.87868C10.4407 4.19808 10.6807 4.5821 10.8284 5H20C20.5523 5 21 5.44772 21 6ZM21 12C21 12.5523 20.5523 13 20 13H18.8284C18.6807 13.4179 18.4407 13.8019 18.1213 14.1213C17.5587 14.6839 16.7957 15 16 15C15.2043 15 14.4413 14.6839 13.8787 14.1213C13.5593 13.8019 13.3193 13.4179 13.1716 13L4 13C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11L13.1716 11C13.3193 10.5821 13.5593 10.1981 13.8787 9.87868C14.4413 9.31607 15.2043 9 16 9C16.7957 9 17.5587 9.31607 18.1213 9.87868C18.4407 10.1981 18.6807 10.5821 18.8284 11H20C20.5523 11 21 11.4477 21 12ZM21 18C21 18.5523 20.5523 19 20 19H10.8284C10.6807 19.4179 10.4407 19.8019 10.1213 20.1213C9.55871 20.6839 8.79565 21 8 21C7.20435 21 6.44129 20.6839 5.87868 20.1213C5.55928 19.8019 5.31933 19.4179 5.17157 19H4C3.44772 19 3 18.5523 3 18C3 17.4477 3.44772 17 4 17H5.17157C5.31933 16.5821 5.55928 16.1981 5.87868 15.8787C6.44129 15.3161 7.20435 15 8 15C8.79565 15 9.55871 15.3161 10.1213 15.8787C10.4407 16.1981 10.6807 16.5821 10.8284 17H20C20.5523 17 21 17.4477 21 18ZM17 12C17 11.7348 16.8946 11.4804 16.7071 11.2929C16.5196 11.1054 16.2652 11 16 11C15.7348 11 15.4804 11.1054 15.2929 11.2929C15.1054 11.4804 15 11.7348 15 12C15 12.2652 15.1054 12.5196 15.2929 12.7071C15.4804 12.8946 15.7348 13 16 13C16.2652 13 16.5196 12.8946 16.7071 12.7071C16.8946 12.5196 17 12.2652 17 12ZM9 6C9 5.73478 8.89464 5.48043 8.70711 5.29289C8.51957 5.10536 8.26522 5 8 5C7.73478 5 7.48043 5.10536 7.29289 5.29289C7.10536 5.48043 7 5.73478 7 6C7 6.26522 7.10536 6.51957 7.29289 6.70711C7.48043 6.89464 7.73478 7 8 7C8.26522 7 8.51957 6.89464 8.70711 6.70711C8.89464 6.51957 9 6.26522 9 6ZM9 18C9 17.7348 8.89464 17.4804 8.70711 17.2929C8.51957 17.1054 8.26522 17 8 17C7.73478 17 7.48043 17.1054 7.29289 17.2929C7.10536 17.4804 7 17.7348 7 18C7 18.2652 7.10536 18.5196 7.29289 18.7071C7.48043 18.8946 7.73478 19 8 19C8.26522 19 8.51957 18.8946 8.70711 18.7071C8.89464 18.5196 9 18.2652 9 18Z" fill="#131313"/>
                            </svg>
                        </div><? $APPLICATION->IncludeFile("/include/service-item-2.php", [], ["MODE" => "html"])?>
                    </li>
                    <li class="advantages__item">
                        <div class="advantages__pic">
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 10.5H21H3ZM7 15.5H8H7ZM12 15.5H13H12ZM6 19.5H18C18.7956 19.5 19.5587 19.1839 20.1213 18.6213C20.6839 18.0587 21 17.2956 21 16.5V8.5C21 7.70435 20.6839 6.94129 20.1213 6.37868C19.5587 5.81607 18.7956 5.5 18 5.5H6C5.20435 5.5 4.44129 5.81607 3.87868 6.37868C3.31607 6.94129 3 7.70435 3 8.5V16.5C3 17.2956 3.31607 18.0587 3.87868 18.6213C4.44129 19.1839 5.20435 19.5 6 19.5Z"
                                      stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div><? $APPLICATION->IncludeFile("/include/service-item-3.php", [], ["MODE" => "html"])?>
                    </li>
                    <li class="advantages__item">
                        <div class="advantages__pic">
                            <svg width="24" height="23" viewBox="0 0 24 23" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.325 4.51407C10.751 2.8813 13.249 2.8813 13.675 4.51407C13.7389 4.75936 13.8642 4.98714 14.0407 5.17889C14.2172 5.37064 14.4399 5.52093 14.6907 5.61753C14.9414 5.71414 15.2132 5.75432 15.4838 5.73481C15.7544 5.7153 16.0162 5.63665 16.248 5.50526C17.791 4.63123 19.558 6.2733 18.618 7.70895C18.4769 7.92435 18.3924 8.16766 18.3715 8.41912C18.3506 8.67058 18.3938 8.92308 18.4975 9.15611C18.6013 9.38913 18.7627 9.5961 18.9687 9.76019C19.1747 9.92428 19.4194 10.0409 19.683 10.1005C21.439 10.4966 21.439 12.8193 19.683 13.2154C19.4192 13.2748 19.1742 13.3913 18.968 13.5554C18.7618 13.7195 18.6001 13.9266 18.4963 14.1597C18.3924 14.3929 18.3491 14.6456 18.3701 14.8972C18.3911 15.1488 18.4757 15.3923 18.617 15.6078C19.557 17.0425 17.791 18.6855 16.247 17.8115C16.0153 17.6803 15.7537 17.6018 15.4832 17.5823C15.2128 17.5628 14.9412 17.603 14.6906 17.6995C14.44 17.796 14.2174 17.9461 14.0409 18.1376C13.8645 18.3291 13.7391 18.5567 13.675 18.8018C13.249 20.4345 10.751 20.4345 10.325 18.8018C10.2611 18.5565 10.1358 18.3287 9.95929 18.1369C9.7828 17.9452 9.56011 17.7949 9.30935 17.6983C9.05859 17.6017 8.78683 17.5615 8.51621 17.581C8.24559 17.6005 7.98375 17.6792 7.752 17.8106C6.209 18.6846 4.442 17.0425 5.382 15.6069C5.5231 15.3915 5.60755 15.1482 5.62848 14.8967C5.64942 14.6452 5.60624 14.3927 5.50247 14.1597C5.3987 13.9267 5.23726 13.7197 5.03127 13.5556C4.82529 13.3915 4.58056 13.275 4.317 13.2154C2.561 12.8193 2.561 10.4966 4.317 10.1005C4.5808 10.041 4.82578 9.92451 5.032 9.76041C5.23822 9.5963 5.39985 9.38924 5.50375 9.15608C5.60764 8.92291 5.65085 8.67023 5.62987 8.4186C5.60889 8.16697 5.5243 7.92351 5.383 7.70802C4.443 6.2733 6.209 4.6303 7.753 5.50433C8.749 6.06967 10.049 5.56942 10.325 4.51407Z"
                                      stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 11.6579C15 12.3977 14.6839 13.1072 14.1213 13.6303C13.5587 14.1535 12.7956 14.4474 12 14.4474C11.2044 14.4474 10.4413 14.1535 9.87868 13.6303C9.31607 13.1072 9 12.3977 9 11.6579C9 10.9181 9.31607 10.2086 9.87868 9.68543C10.4413 9.1623 11.2044 8.86841 12 8.86841C12.7956 8.86841 13.5587 9.1623 14.1213 9.68543C14.6839 10.2086 15 10.9181 15 11.6579V11.6579Z"
                                      stroke="#131313" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div><? $APPLICATION->IncludeFile("/include/service-item-4.php", [], ["MODE" => "html"])?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="_container _container--mode">
            <div class="tabs">
                <div class="tabs__nav">
                    <button class="tabs__btn active">Описание</button>
                    <? if ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] || $arResult['PROPERTIES']['AUDIOGRAM']['VALUE']) { ?>
                        <button class="tabs__btn">Характеристики</button>
                    <? } ?>
                    <? if ($arResult['ADD_ELEMENTS']) { ?>
                        <button class="tabs__btn">Аксессуары</button>
                    <? } ?>
                </div>
                <div class="tabs__content">
                    <div class="tabs__pane show">
                        <div class="tabs__pane-wrap tabs__pane-wrap--product">
                            <div class="tabs__pane-box">
                                <h2 class="section-title">Описание </h2>
                                <div class="tabs__par">
                                    <p><?=$arResult['DETAIL_TEXT'] ? html_entity_decode($arResult['DETAIL_TEXT']) : 'Описание не добавлено.'?></p>
                                    <!--                                    --><? //if ($arResult['DETAIL_TEXT']) { ?>
                                    <!--                                        <a class="tabs__par-show show-text">Показать все</a>-->
                                    <!--                                    --><? //} ?>
                                </div>
                            </div>
                            <? if ($arResult['PROPERTIES']['AKUSTICHESKIE_SITUATSII2']['VALUE']) { ?>
                                <div class="tabs__pane-box">
                                    <h2 class="section-title">Ситуации</h2>
                                    <ul class="tabs__pane-list">
                                        <? foreach($arResult['PROPERTIES']['AKUSTICHESKIE_SITUATSII2']['VALUE'] AS &$value) { ?>
                                            <li class="tabs__pane-item">
                                                <div class="tabs__pane-item__pic">
                                                    <? if ($value == 'просмотр ТВ') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-tv.svg"
                                                                    alt="просмотр ТВ"></div>
                                                    <? } else if ($value == 'транспорт') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-transport.svg"
                                                                    alt="транспорт"></div>
                                                    <? } else if ($value == 'музыка') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/md-transport.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'разговоры дома') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/разговоры дома.svg"
                                                                    alt="транспорт"></div>
                                                    <? } else if ($value == 'телефонный или видеозвонок') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/телефонный или видеозвонок.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'прием у врача') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/прием у врача.svg"
                                                                    alt="транспорт"></div>
                                                    <? } else if ($value == 'посещение ресторана') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/посещение ресторана.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'в машине') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/в машине.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'концерт вечеринка') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/концерт вечеринка.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'на прогулке') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/на прогулке.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'поход в магазин') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/поход в магазин.svg"
                                                                    alt="музыка"></div>
                                                    <? } else if ($value == 'театр, лекция, конференция') { ?>
                                                        <div class="tabs__pane-item__pic"><img
                                                                    src="<?=SITE_TEMPLATE_PATH ?>/images/icns/театр лекция конференция.svg"
                                                                    alt="музыка"></div>
                                                    <? } else { ?>
                                                        <img src="<?=SITE_TEMPLATE_PATH ?>/images/icns/work.svg"
                                                             alt="Работа">
                                                    <? } ?>
                                                </div>
                                                <?=$value?>
                                            </li>
                                        <? } ?>
                                    </ul>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                    <? if ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] || $arResult['PROPERTIES']['AUDIOGRAM']['VALUE']) { ?>
                        <div class="tabs__pane">
                            <div class="tabs__pane-wrap tabs__pane-wrap--product">
                                <div class="tabs__pane-box">
                                    <? if ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE']) { ?>
                                        <h2 class="section-title">Характеристики</h2>
                                        <ul class="tabs__list">
                                            <? foreach ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE'] as $iValueKey => $sValue) { ?>
                                                <? foreach ($arResult['PROPERTIES']['CML2_ATTRIBUTES']['DESCRIPTION'] as $iDescriptionKey => $sDescription) { ?>
                                                    <? if ($iValueKey == $iDescriptionKey) { ?>
                                                        <li><?=$sValue?><?=$sDescription ? "– $sDescription" : ''?><?=count($arResult['PROPERTIES']['CML2_ATTRIBUTES']['VALUE']) == $iDescriptionKey + 1 ? '.' : ';'?></li>
                                                    <? } ?>
                                                <? } ?>
                                            <? } ?>
                                        </ul>
                                    <? } ?>
                                    <? if ($arResult['PROPERTIES']['AUDIOGRAM']['VALUE']) { ?>
                                        <h2 class="section-title">Аудиограмма</h2>
                                        <? foreach ($arResult['PROPERTIES']['AUDIOGRAM']['VALUE'] as $iID) { ?>
                                            <img src="<?=\CFile::GetPath($iID)?>"
                                                 alt="Аудиограмма">
                                        <? } ?>
                                    <? } ?>
                                </div>

                                <? if ($arResult['FILES']) { ?>
                                    <div class="tabs__pane-box">
                                        <h2 class="section-title">Спецификации</h2>
                                        <ul class="tabs__pane-list">
                                            <? foreach ($arResult['FILES'] as $arFile) { ?>
                                                <? $format = substr($arFile['SRC'], strripos($arFile['SRC'], '.') + 1)?>
                                                <li class="tabs__pane-item">
                                                    <a class="tabs__pane-link" target="_blank" href="<?=$arFile['SRC']?>">
                                                        <div class="tabs__pane-item__pic tabs__pane-item__pic--mode">
                                                            <img src="<?=SITE_TEMPLATE_PATH ?>/images/icns/pdf.svg"
                                                                 alt=""></div>
                                                        <div>
                                                            <span class="tabs__pane-link-name"><?=$arFile['ORIGINAL_NAME']?></span><span>(<?=strtoupper($format)?>, <?=\CFile::FormatSize($arFile['FILE_SIZE'])?>)</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                <? } ?>

                            </div>
                        </div>
                    <? } ?>

                    <? if ($arResult['ADD_ELEMENTS']) { ?>
                        <div class="tabs__pane">
                            <h2 class="section-title">Аксессуары</h2>
                            <div class="cards-box">
                                <? foreach ($arResult['ADD_ELEMENTS'] AS $arItem) { ?>
                                    <div class="card">
                                        <a class="card__pic" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                            <img src="<?=$arItem['PREVIEW_PICTURE'] ? \CFile::GetPath($arItem['PREVIEW_PICTURE']) : SITE_TEMPLATE_PATH . '/images/no-photo.png'?>"
                                                 alt="<?=$arItem['NAME']?>">
                                        </a>
                                        <span class="card__category"><?=$arItem['SECTION']?></span>
                                        <a class="card__name"
                                           href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                                        <div class="card__footer">
                                            <div class="card__price card__price--actual"><?=number_format($arItem['PRICE']['PRICE'], 0, '', ' ')?>
                                                ₸
                                            </div>
                                            <? if ($arItem['OLD_PRICE_VALUE'] && $arItem['OLD_PRICE_VALUE'] > $arItem['PRICE']['PRICE']) { ?>
                                                <div class="product-descr__old-price"><?=number_format($arItem['OLD_PRICE_VALUE'], 0, '', ' ')?>
                                                    ₸
                                                </div>
                                            <? } ?>
                                        </div>
                                        <button class="btn btn--red btn--icn btn--m"
                                                data-id="<?=$arItem['ID']?>" data-quantity="1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17 9V8C17 5.2385 14.7615 3 12 3C9.2385 3 7 5.2385 7 8V9H4C3.44772 9 3 9.44772 3 10V18C3 19.6575 4.3425 21 6 21H18C19.6575 21 21 19.6575 21 18V10C21 9.44772 20.5523 9 20 9H17ZM9 8C9 6.34325 10.3433 5 12 5C13.6567 5 15 6.34325 15 8V9H9V8ZM19 18C19 18.5525 18.5525 19 18 19H6C5.4475 19 5 18.5525 5 18V11H19V18Z"
                                                      fill="white"/>
                                            </svg>
                                            В корзину
                                        </button>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>

<? $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
)?>

<?php
global $arSimilarFilter;
//$arSimilarFilter['ID'] = $arResult['PROPERTIES']['SIMILAR']['VALUE'];
//$arSimilarFilter['SECTION_ID'] = $arResult['ROOT_SECTION_ID'];
//var_dump($arSimilarFilter);
$APPLICATION->IncludeComponent("bitrix:catalog.section", "similar", array(
    "COMPONENT_TEMPLATE" => ".default",
    "IBLOCK_TYPE" => "1c_catalog",    // Тип инфоблока
    "IBLOCK_ID" => "1",    // Инфоблок
    "SECTION_USER_FIELDS" => array(    // Свойства раздела
        0 => "",
        1 => "",
    ),
    "USE_FILTER" => "Y",
    'FILTER_NAME' => 'arSimilarFilter',
    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
    "SHOW_ALL_WO_SECTION" => "Y",    // Показывать все элементы, если не указан раздел
    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",    // Фильтр товаров
    "HIDE_NOT_AVAILABLE" => "N",    // Недоступные товары
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",    // Недоступные торговые предложения
    "ELEMENT_SORT_FIELD" => "RAND",    // По какому полю сортируем элементы
    "ELEMENT_SORT_ORDER" => "ASC",    // Порядок сортировки элементов
    "ELEMENT_SORT_FIELD2" => "show_counter",    // Поле для второй сортировки элементов
    "ELEMENT_SORT_ORDER2" => "desc",    // Порядок второй сортировки элементов
    "PAGE_ELEMENT_COUNT" => "8",    // Количество элементов на странице
    "LINE_ELEMENT_COUNT" => "3",    // Количество элементов выводимых в одной строке таблицы
    "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
    "TEMPLATE_THEME" => "blue",    // Цветовая тема
    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",    // Вариант отображения товаров
    "ENLARGE_PRODUCT" => "STRICT",    // Выделять товары в списке
    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",    // Порядок отображения блоков товара
    "SHOW_SLIDER" => "N",    // Показывать слайдер для товаров
    "ADD_PICT_PROP" => "-",    // Дополнительная картинка основного товара
    "LABEL_PROP" => array(    // Свойства меток товара
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
    "LABEL_PROP_MOBILE" => array(    // Свойства меток товара, отображаемые на мобильных устройствах
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
    "LABEL_PROP_POSITION" => "top-left",    // Расположение меток товара
    "PRODUCT_SUBSCRIPTION" => "N",    // Разрешить оповещения для отсутствующих товаров
    "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
    "SHOW_OLD_PRICE" => "N",    // Показывать старую цену
    "SHOW_MAX_QUANTITY" => "N",    // Показывать остаток товара
    "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
    "MESS_BTN_BUY" => "",    // Текст кнопки "Купить"
    "MESS_BTN_ADD_TO_BASKET" => "",    // Текст кнопки "Добавить в корзину"
    "MESS_BTN_SUBSCRIBE" => "",    // Текст кнопки "Уведомить о поступлении"
    "MESS_BTN_DETAIL" => "",    // Текст кнопки "Подробнее"
    "MESS_NOT_AVAILABLE" => "",    // Сообщение об отсутствии товара
    "MESS_NOT_AVAILABLE_SERVICE" => "",    // Сообщение о недоступности услуги
    "RCM_TYPE" => "personal",    // Тип рекомендации
    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],    // Параметр ID продукта (для товарных рекомендаций)
    "SHOW_FROM_SECTION" => "N",    // Показывать товары из раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "DETAIL_URL" => "/product/#ELEMENT_CODE#/",    // URL, ведущий на страницу с содержимым элемента раздела
    "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
    "SEF_MODE" => "Y",    // Включить поддержку ЧПУ
    "SEF_RULE" => "",    // Правило для обработки
    "SECTION_ID" => $arResult['ROOT_SECTION_ID'], //$_REQUEST["SECTION_ID"],    // ID раздела
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],    // Путь из символьных кодов раздела
    "AJAX_MODE" => "N",    // Включить режим AJAX
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
    "CACHE_TYPE" => "A",    // Тип кеширования
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
    "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
    "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
    "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
    "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
    "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
    "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
    "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
    "ADD_SECTIONS_CHAIN" => "Y",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
    "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
    "PRICE_CODE" => array(    // Тип цены
        0 => "Розничная цена",
    ),
    "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
    "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
    "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
    "CONVERT_CURRENCY" => "N",    // Показывать цены в одной валюте
    "BASKET_URL" => "/personal/cart/",    // URL, ведущий на страницу с корзиной покупателя
    "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",    // Название переменной, в которой передается количество товара
    "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
    "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
    "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
    "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
    "DISPLAY_COMPARE" => "N",    // Разрешить сравнение товаров
    "USE_ENHANCED_ECOMMERCE" => "N",    // Отправлять данные электронной торговли в Google и Яндекс
    "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
    "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
    "PAGER_TITLE" => "Товары",    // Название категорий
    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
    "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
    "LAZY_LOAD" => "N",    // Показать кнопку ленивой загрузки Lazy Load
    "MESS_BTN_LAZY_LOAD" => "Показать ещё",    // Текст кнопки "Показать ещё"
    "LOAD_ON_SCROLL" => "N",    // Подгружать товары при прокрутке до конца
    "SET_STATUS_404" => "Y",    // Устанавливать статус 404
    "SHOW_404" => "N",    // Показ специальной страницы
    "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
    "COMPATIBLE_MODE" => "N",    // Включить режим совместимости
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",    // Не подключать js-библиотеки в компоненте
),
    false
)?>