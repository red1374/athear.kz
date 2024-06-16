<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @global CMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponent $component */
?>

<form action="" method="get" class="catalog__head-input">

    <? if ($arParams["USE_SUGGEST"] === "Y"):
        if (mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"])) {
            $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
            $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
            $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
        }
        ?>
        <? $APPLICATION->IncludeComponent(
        "bitrix:search.suggest.input",
        "",
        array(
            "NAME" => "q",
            "VALUE" => $arResult["REQUEST"]["~QUERY"],
            "INPUT_SIZE" => 40,
            "DROPDOWN_SIZE" => 10,
            "FILTER_MD5" => $arResult["FILTER_MD5"],
        ),
        $component, array("HIDE_ICONS" => "Y")
    ); ?>
    <? else: ?>
        <input type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>" size="40" placeholder="Поиск товаров на сайте"/>
    <? endif; ?>
    <button class="catalog__head-input-btn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10 4C8.4087 4 6.88258 4.63214 5.75736 5.75736C4.63214 6.88258 4 8.4087 4 10C4 10.7879 4.15519 11.5681 4.45672 12.2961C4.75825 13.0241 5.20021 13.6855 5.75736 14.2426C6.31451 14.7998 6.97595 15.2417 7.7039 15.5433C8.43185 15.8448 9.21207 16 10 16C10.7879 16 11.5681 15.8448 12.2961 15.5433C13.0241 15.2417 13.6855 14.7998 14.2426 14.2426C14.7998 13.6855 15.2417 13.0241 15.5433 12.2961C15.8448 11.5681 16 10.7879 16 10C16 8.4087 15.3679 6.88258 14.2426 5.75736C13.1174 4.63214 11.5913 4 10 4ZM4.34315 4.34315C5.84344 2.84285 7.87827 2 10 2C12.1217 2 14.1566 2.84285 15.6569 4.34315C17.1571 5.84344 18 7.87827 18 10C18 11.0506 17.7931 12.0909 17.391 13.0615C17.1172 13.7226 16.7565 14.3425 16.3196 14.9054L21.7071 20.2929C22.0976 20.6834 22.0976 21.3166 21.7071 21.7071C21.3166 22.0976 20.6834 22.0976 20.2929 21.7071L14.9054 16.3196C14.3425 16.7565 13.7226 17.1172 13.0615 17.391C12.0909 17.7931 11.0506 18 10 18C8.94943 18 7.90914 17.7931 6.93853 17.391C5.96793 16.989 5.08601 16.3997 4.34315 15.6569C3.60028 14.914 3.011 14.0321 2.60896 13.0615C2.20693 12.0909 2 11.0506 2 10C2 7.87827 2.84285 5.84344 4.34315 4.34315Z"
                  fill="#131313"/>
        </svg>
    </button>
    <input type="hidden" name="how" value="<? echo $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r" ?>"/>
    <? if ($arParams["SHOW_WHEN"]): ?>
        <script>
            var switch_search_params = function () {
                var sp = document.getElementById('search_params');
                var flag;

                if (sp.style.display == 'none') {
                    flag = false;
                    sp.style.display = 'block'
                } else {
                    flag = true;
                    sp.style.display = 'none';
                }

                var from = document.getElementsByName('from');
                for (var i = 0; i < from.length; i++)
                    if (from[i].type.toLowerCase() == 'text')
                        from[i].disabled = flag

                var to = document.getElementsByName('to');
                for (var i = 0; i < to.length; i++)
                    if (to[i].type.toLowerCase() == 'text')
                        to[i].disabled = flag

                return false;
            }
        </script>
        <br/><a class="search-page-params" href="#"
                onclick="return switch_search_params()"><? echo GetMessage('CT_BSP_ADDITIONAL_PARAMS') ?></a>
        <div id="search_params" class="search-page-params"
             style="display:<? echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"] ? 'block' : 'none' ?>">
            <? $APPLICATION->IncludeComponent(
                'bitrix:main.calendar',
                '',
                array(
                    'SHOW_INPUT' => 'Y',
                    'INPUT_NAME' => 'from',
                    'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
                    'INPUT_NAME_FINISH' => 'to',
                    'INPUT_VALUE_FINISH' => $arResult["REQUEST"]["~TO"],
                    'INPUT_ADDITIONAL_ATTR' => 'size="10"',
                ),
                null,
                array('HIDE_ICONS' => 'Y')
            ); ?>
        </div>
    <? endif ?>
</form>

<? if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
    ?>
    <div class="search-language-guess">
        <? echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#" => '<a href="' . $arResult["ORIGINAL_QUERY_URL"] . '">' . $arResult["REQUEST"]["ORIGINAL_QUERY"] . '</a>')) ?>
    </div><br/><?
endif; ?>

<?php if (!$arResult['REQUEST']['QUERY']) { ?>
    <p>Введите запрос.</p>
<?php } ?>
