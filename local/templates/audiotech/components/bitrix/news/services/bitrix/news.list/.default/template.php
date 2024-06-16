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

<section class="info-blocks">
    <div class="_container">
        <h1 class="title-page"><?php $APPLICATION->ShowTitle(false); ?></h1>
        <div class="info-blocks__wrap">
            <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                <div class="info-block__item"
                     style="background-image: url(<?php echo $arItem['PREVIEW_PICTURE']['SRC']; ?>)">
                    <div class="info-block__name"><?php echo $arItem['NAME']; ?></div>
                    <div class="info-block__descr"><?php echo $arItem['PREVIEW_TEXT']; ?></div>
                    <a class="btn btn--white btn--m info-block__link"
                       href="<?php echo $arItem['DETAIL_PAGE_URL']; ?>">Перейти</a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>