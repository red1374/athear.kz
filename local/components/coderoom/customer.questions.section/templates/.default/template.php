<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    $this->setFrameMode(true);
    /**
     * @global $arResult
     */
    if (empty($arResult['ITEMS'])){
        return "";
    }
?>
<section class="questions">
    <div class="_container">
        <h2 class="section-title">
            <span><?=($arParams['BLOCK_TITLE'] ? $arParams['BLOCK_TITLE'] : GetMessage('CT_TITLE'))?></span>
            <? if ($arParams['QUESTIONS_URL']):?>
            <a href="<?=$arParams['QUESTIONS_URL']?>" class="btn btn--grey btn--m"><?=GetMessage('CT_QUESTIONS')?></a>
            <? endif?>
        </h2>
        <div class="accordion accordion--mode" id="accordion">
            <? foreach($arResult['ITEMS'] AS $i => &$arItem) { ?>
                <div class="accordion__item">
                    <div class="accordion__header"> <span>0<?=($i + 1)?></span><span><?=$arItem['NAME']?></span></div>
                    <div class="accordion__body">
                        <div class="accordion__content">
                            <p><?=$arItem['PREVIEW_TEXT']?></p>
                        </div>
                    </div>
                </div>
                <? $i++?>
            <?} ?>
        </div>
    </div>
</section>