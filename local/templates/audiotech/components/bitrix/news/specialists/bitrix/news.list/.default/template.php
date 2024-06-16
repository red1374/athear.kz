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
<div class="about__doctors doctors">
    <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
        <div class="doctors__item">
            <img class="doctors__pic" src="<?php echo $arItem['PREVIEW_PICTURE']['SRC']; ?>"
                 alt="<?php echo $arItem['NAME']; ?>">
            <span class="doctors__profile"><?php echo $arItem['PROPERTIES']['SPECIALIZATION']['VALUE']; ?></span>
            <span class="doctors__name"><?php echo $arItem['NAME']; ?></span>
            <span class="doctors__education"><?php echo htmlspecialchars_decode($arItem['PREVIEW_TEXT']); ?></span>
            <div class="doctors__location">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.05051 4.04999C6.36333 2.73717 8.14389 1.99963 10.0005 1.99963C11.8571 1.99963 13.6377 2.73717 14.9505 4.04999C16.2633 5.36281 17.0009 7.14338 17.0009 8.99999C17.0009 10.8566 16.2633 12.6372 14.9505 13.95L10.0005 18.9L5.05051 13.95C4.40042 13.3 3.88474 12.5283 3.53291 11.6789C3.18108 10.8296 3 9.9193 3 8.99999C3 8.08068 3.18108 7.17037 3.53291 6.32104C3.88474 5.47172 4.40042 4.70001 5.05051 4.04999ZM10.0005 11C10.5309 11 11.0396 10.7893 11.4147 10.4142C11.7898 10.0391 12.0005 9.53042 12.0005 8.99999C12.0005 8.46956 11.7898 7.96085 11.4147 7.58578C11.0396 7.2107 10.5309 6.99999 10.0005 6.99999C9.47007 6.99999 8.96136 7.2107 8.58629 7.58578C8.21122 7.96085 8.0005 8.46956 8.0005 8.99999C8.0005 9.53042 8.21122 10.0391 8.58629 10.4142C8.96136 10.7893 9.47007 11 10.0005 11Z"
                          fill="#CCCCCC"/>
                </svg>
                <span><?php echo $arItem['PROPERTIES']['WORK_LOCATION']['VALUE']; ?></span></div>
            <button class="btn btn--red btn--m doctors__item-btn" data-target="modal-reg">Записаться
                на приём
            </button>
        </div>
    <?php } ?>
</div>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"] && count($arResult["ITEMS"]) > 7) { ?>
    <div class="pagination">
        <?= $arResult["NAV_STRING"]; ?>
    </div>
<?php } else { ?>
    <div class="news-bottom"></div>
<?php } ?>
