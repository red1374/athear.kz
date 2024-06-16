<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
?>
<div class="__inner">
    <div class="order__content">
        <div class="order__block"><?=Loc::getMessage(
            'EMPTY_BASKET_HINT',
            [
                '#A1#' => '<a class="link" href="'.$arParams['EMPTY_BASKET_HINT_PATH'].'">',
                '#A2#' => '</a>',
            ]
        )?></div>
    </div>
</div>