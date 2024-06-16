<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

/**
 * @global $arResult
 */
?>

<section class="questions">
    <div class="_container">
        <h2 class="section-title"> <span>Вопросы по гарантии и возврату</span>
            <a href="/customer/questions/" class="btn btn--grey btn--m">Вопросы и ответы</a>
        </h2>
        <div class="accordion accordion--mode" id="accordion">
            <?php $i = 1; ?>
            <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                <div class="accordion__item">
                    <div class="accordion__header"> <span>0<?php echo $i; ?></span><span><?php echo $arItem['NAME']; ?></span></div>
                    <div class="accordion__body">
                        <div class="accordion__content">
                            <p><?php echo $arItem['PREVIEW_TEXT']; ?></p>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php } ?>
        </div>
    </div>
</section>