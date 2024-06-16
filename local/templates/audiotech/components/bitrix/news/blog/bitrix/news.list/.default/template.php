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

    <div class="news">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="article-preview"><a class="article-preview__pic"
                                            href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                         alt="<? echo $arItem["NAME"] ?>"></a>
                <?php
                $dateCreate = CIBlockFormatProperties::DateFormat(
                    'j M Y',
                    MakeTimeStamp(
                        $arItem["TIMESTAMP_X"],
                        CSite::GetDateFormat()
                    )
                );
                ?>
                <div class="article-preview__date"><? echo $dateCreate ?></div>
                <a class="article-preview__name"
                   href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
                <p class="article-preview__text"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
            </div>
        <? endforeach; ?>
        <?php if (count($arResult["ITEMS"]) < 2) { ?>
            <div></div>
            <div></div>
        <?php } else if (count($arResult["ITEMS"]) < 3) { ?>
            <div></div>
        <?php } ?>
        <form class="subscribe email_form">
            <input type="hidden" name="formName" value="Подписаться на рассылку">
            <h2 class="aside-block__title">Подписаться на рассылку</h2>
            <div class="input__overlay email_form">
                <input class="input-default" name="email" type="email" placeholder="Электронная почта">
            </div>
            <p class="aside-block__agree">Подписываясь, вы даете согласие на <a href="">обработку
                    персональных данных</a>
            </p>
            <button class="btn btn--red btn--l btn--icn" type="submit">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z"
                          stroke="white" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                <span>Подписаться</span></button>
        </form>
    </div>
<?php if ($arParams["DISPLAY_BOTTOM_PAGER"] && count($arResult["ITEMS"]) > 11) { ?>
    <div class="pagination">
        <?= $arResult["NAV_STRING"]; ?>
    </div>
<?php } else { ?>
    <div class="news-bottom"></div>
<?php } ?>