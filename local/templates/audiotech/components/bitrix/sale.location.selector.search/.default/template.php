<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @global CMain $APPLICATION */
/** @var array $arResult */

/** @var array $arParams */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION;

$uiFilter = isset($arParams["UI_FILTER"]) && $arParams["UI_FILTER"];
if ($uiFilter) {
    $arParams["USE_POPUP"] = true;
}

\Bitrix\Main\UI\Extension::load('ui.design-tokens');

if (!empty($arResult['ERRORS']['FATAL'])):
    foreach ($arResult['ERRORS']['FATAL'] as $error):
        ShowError($error);
    endforeach;
else:
    $APPLICATION->AddHeadScript('/bitrix/js/sale/core_ui_widget.js');
    $APPLICATION->AddHeadScript('/bitrix/js/sale/core_ui_etc.js');
    $APPLICATION->AddHeadScript('/bitrix/js/sale/core_ui_autocomplete.js');
    ?>
<div id="sls-<?=$arResult['RANDOM_TAG'] ?>"
     class="bx-sls <?=($arResult['MODE_CLASSES'] !== '' ? $arResult['MODE_CLASSES'] : ''); ?>">
    <? if (!empty($arResult['DEFAULT_LOCATIONS']) && is_array($arResult['DEFAULT_LOCATIONS'])):?>
        <div class="bx-ui-sls-quick-locations quick-locations">
            <? foreach ($arResult['DEFAULT_LOCATIONS'] AS $lid => &$loc):?>
                <a href="javascript:void(0)" data-id="<?=intval($loc['ID']) ?>"
                   class="quick-location-tag"><?=htmlspecialcharsbx($loc['NAME']) ?></a>
            <? endforeach?>
        </div>
    <? endif;
    $dropDownBlock = $uiFilter ? "dropdown-block-ui" : "dropdown-block"; ?>
        <li class="profile__item order__city <?=$dropDownBlock ?> bx-ui-sls-input-block">
            <div class="order__city-wrap">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M10 4C8.4087 4 6.88258 4.63214 5.75736 5.75736C4.63214 6.88258 4 8.4087 4 10C4 10.7879 4.15519 11.5681 4.45672 12.2961C4.75825 13.0241 5.20021 13.6855 5.75736 14.2426C6.31451 14.7998 6.97595 15.2417 7.7039 15.5433C8.43185 15.8448 9.21207 16 10 16C10.7879 16 11.5681 15.8448 12.2961 15.5433C13.0241 15.2417 13.6855 14.7998 14.2426 14.2426C14.7998 13.6855 15.2417 13.0241 15.5433 12.2961C15.8448 11.5681 16 10.7879 16 10C16 8.4087 15.3679 6.88258 14.2426 5.75736C13.1174 4.63214 11.5913 4 10 4ZM4.34315 4.34315C5.84344 2.84285 7.87827 2 10 2C12.1217 2 14.1566 2.84285 15.6569 4.34315C17.1571 5.84344 18 7.87827 18 10C18 11.0506 17.7931 12.0909 17.391 13.0615C17.1172 13.7226 16.7565 14.3425 16.3196 14.9054L21.7071 20.2929C22.0976 20.6834 22.0976 21.3166 21.7071 21.7071C21.3166 22.0976 20.6834 22.0976 20.2929 21.7071L14.9054 16.3196C14.3425 16.7565 13.7226 17.1172 13.0615 17.391C12.0909 17.7931 11.0506 18 10 18C8.94943 18 7.90914 17.7931 6.93853 17.391C5.96793 16.989 5.08601 16.3997 4.34315 15.6569C3.60028 14.914 3.011 14.0321 2.60896 13.0615C2.20693 12.0909 2 11.0506 2 10C2 7.87827 2.84285 5.84344 4.34315 4.34315Z"
                          fill="#131313"/>
                </svg>
                <input class="input dropdown-field" type="text" autocomplete="off" name="<?=$arParams['INPUT_NAME'] ?>"
                       value="<?=$arResult['VALUE'] ?>" placeholder="Город" required/>
                <div class="bx-ui-sls-pane"></div>
            </div>
            <?/*<div class="dropdown-fade2white"></div>*/?>
            <div class="bx-ui-sls-loader"></div>
        </li>

        <script type="text/html" data-template-id="bx-ui-sls-error">
            <div class="bx-ui-sls-error">
                <div></div>
                {{message}}
            </div>
        </script>

        <script type="text/html" data-template-id="bx-ui-sls-dropdown-item">
            <div class="dropdown-item bx-ui-sls-variant">
                <span class="dropdown-item-text">{{display_wrapped}}</span>
                <? if ($arResult['ADMIN_MODE']):?>
                    [{{id}}]
                <? endif ?>
            </div>
        </script>

        <div class="bx-ui-sls-error-message">
            <? if (!isset($arParams['SUPPRESS_ERRORS']) || !$arParams['SUPPRESS_ERRORS']):
                if (!empty($arResult['ERRORS']['NONFATAL'])):
                    foreach ($arResult['ERRORS']['NONFATAL'] AS &$error):
                        ShowError($error);
                    endforeach;
                endif;
            endif ?>
        </div>

    </div>

    <script>
        if (!window.BX && top.BX)
            window.BX = top.BX;
        <? if($arParams['JS_CONTROL_DEFERRED_INIT'] <> ''): ?>
        if (typeof window.BX.locationsDeferred == 'undefined') window.BX.locationsDeferred = {};
        window.BX.locationsDeferred['<?=$arParams['JS_CONTROL_DEFERRED_INIT']?>'] = function () {
        <? endif;
        if ($arParams['JS_CONTROL_GLOBAL_ID'] <> ''): ?>
            if (typeof window.BX.locationSelectors == 'undefined') window.BX.locationSelectors = {};
            window.BX.locationSelectors['<?=$arParams['JS_CONTROL_GLOBAL_ID']?>'] =
            <? endif?>
                new BX.Sale.component.location.selector.search(<?=CUtil::PhpToJSObject(array(
                    // common
                    'scope' => 'sls-' . $arResult['RANDOM_TAG'],
                    'source' => $this->__component->getPath() . '/get.php',
                    'query' => array(
                        'FILTER' => array(
                            'EXCLUDE_ID' => intval($arParams['EXCLUDE_SUBTREE']),
                            'SITE_ID' => $arParams['FILTER_BY_SITE'] && !empty($arParams['FILTER_SITE_ID']) ? $arParams['FILTER_SITE_ID'] : ''
                        ),
                        'BEHAVIOUR' => array(
                            'SEARCH_BY_PRIMARY' => $arParams['SEARCH_BY_PRIMARY'] ? '1' : '0',
                            'LANGUAGE_ID' => LANGUAGE_ID
                        ),
                    ),

                    'selectedItem' => !empty($arResult['LOCATION']) ? $arResult['LOCATION']['VALUE'] : false,
                    'knownItems' => $arResult['KNOWN_ITEMS'],
                    'provideLinkBy' => $arParams['PROVIDE_LINK_BY'],

                    'messages' => array(
                        'nothingFound' => Loc::getMessage('SALE_SLS_NOTHING_FOUND'),
                        'error' => Loc::getMessage('SALE_SLS_ERROR_OCCURED'),
                    ),

                    // "js logic"-related part
                    'callback' => $arParams['JS_CALLBACK'],
                    'useSpawn' => $arParams['USE_JS_SPAWN'] == 'Y',
                    'usePopup' => (bool)$arParams["USE_POPUP"],
                    'initializeByGlobalEvent' => $arParams['INITIALIZE_BY_GLOBAL_EVENT'],
                    'globalEventScope' => $arParams['GLOBAL_EVENT_SCOPE'],

                    // specific
                    'pathNames' => $arResult['PATH_NAMES'], // deprecated
                    'types' => $arResult['TYPES'],

                ), false, false, true)?>);

            <? if ($arParams['JS_CONTROL_DEFERRED_INIT'] <> ''): ?>
        };
        <? endif?>
    </script>
<? endif;