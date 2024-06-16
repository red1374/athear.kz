<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>
<div class="main-slider">
    <div class="parallax-bg"></div>
    <div class="swiper-wrapper">
        <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
            <div class="swiper-slide" style="background-image: url(<?php echo CFile::GetPath($arItem['PREVIEW_PICTURE']); ?>); background-size: cover; background-position: center;" data-mobile="<?php echo CFile::GetPath($arItem['BANNER_MOBILE_VALUE']); ?>">
                <div class="_container">
                    <div class="main-slider__box">
                        <div class="main-slider__subtitle"><?php echo $arItem['SUBTITLE_VALUE']; ?></div>
                        <h2 class="main-slider__title"><?php echo $arItem['NAME']; ?></h2>
                        <a class="btn btn--red btn--l btn--icn btn__main-slider"
                           href="<?php echo $arItem['LINK_VALUE']; ?>">
                            <?php if ($arItem['BTN_TEXT_VALUE'] == 'Узнать подробнее') { ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 8V12V8ZM12 16H12.01H12ZM21 12C21 13.1819 20.7672 14.3522 20.3149 15.4442C19.8626 16.5361 19.1997 17.5282 18.364 18.364C17.5282 19.1997 16.5361 19.8626 15.4442 20.3149C14.3522 20.7672 13.1819 21 12 21C10.8181 21 9.64778 20.7672 8.55585 20.3149C7.46392 19.8626 6.47177 19.1997 5.63604 18.364C4.80031 17.5282 4.13738 16.5361 3.68508 15.4442C3.23279 14.3522 3 13.1819 3 12C3 9.61305 3.94821 7.32387 5.63604 5.63604C7.32387 3.94821 9.61305 3 12 3C14.3869 3 16.6761 3.94821 18.364 5.63604C20.0518 7.32387 21 9.61305 21 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            <?php } else { ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 11H5M19 11C19.5304 11 20.0391 11.2107 20.4142 11.5858C20.7893 11.9609 21 12.4696 21 13V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V13C3 12.4696 3.21071 11.9609 3.58579 11.5858C3.96086 11.2107 4.46957 11 5 11M19 11V9C19 8.46957 18.7893 7.96086 18.4142 7.58579C18.0391 7.21071 17.5304 7 17 7M5 11V9C5 8.46957 5.21071 7.96086 5.58579 7.58579C5.96086 7.21071 6.46957 7 7 7M17 7V5C17 4.46957 16.7893 3.96086 16.4142 3.58579C16.0391 3.21071 15.5304 3 15 3H9C8.46957 3 7.96086 3.21071 7.58579 3.58579C7.21071 3.96086 7 4.46957 7 5V7M17 7H7"
                                          stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            <?php } ?>
                            <?php echo $arItem['BTN_TEXT_VALUE']; ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="_container _container--abs">
        <div class="swiper-nav">
            <div class="swiper-nav__box">
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
        <div class="swiper-pagination"></div>
    </div>
</div>