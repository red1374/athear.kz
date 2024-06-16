<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arMenu = [];
$lastIndex = 0;
foreach($arResult AS $iFirstLevelKey => &$arFirstLevelLink){
    if ($arFirstLevelLink['DEPTH_LEVEL'] == 1){
        $arMenu[$arFirstLevelLink['ITEM_INDEX']] = $arFirstLevelLink;

        foreach ($arResult AS $iSecondLevelKey => &$arSecondLevelLink){
            if ($iSecondLevelKey <= $iFirstLevelKey || $arSecondLevelLink['DEPTH_LEVEL'] == 3){
                continue;
            }
            if ($arSecondLevelLink['DEPTH_LEVEL'] == 1){
                break;
            }

            $arMenu[$iFirstLevelKey]['CHILD'][$iSecondLevelKey] = $arSecondLevelLink;

            foreach ($arResult AS $iThirdLevelKey => &$arThirdLevelLink){
                if ($iThirdLevelKey <= $iSecondLevelKey){
                    continue;
                }
                if (in_array($arThirdLevelLink['DEPTH_LEVEL'], [1,2])){
                    break;
                }
                $arMenu[$iFirstLevelKey]['CHILD'][$iSecondLevelKey]['CHILD'][$iThirdLevelKey] = $arThirdLevelLink;
            }
        }
    }
}
?>
<ul class="main-nav__list">
    <? foreach ($arMenu as $iFirstLevelKey => $arFirstLevel) { ?>
        <li class="main-nav__item <?=$arFirstLevel['SELECTED'] ? 'active' : ''?>">
            <a class="main-nav__link <?=$arFirstLevel['CHILD'] ? 'main-nav__link--arrow' : ''?>" href="<?=$arFirstLevel['ADDITIONAL_LINKS'][0]?>">
                <?=$arFirstLevel['TEXT']?>
            </a>
            <? if ($arFirstLevel['CHILD']) {
                if ($iFirstLevelKey == 0) { ?>
                    <div class="main-nav__submenu-wrap main-nav__submenu-wrap--full-screen">
                        <div class="main-nav__submenu">
                            <div class="_container">
                                <div class="main-submenu__box">
                                    <? foreach ($arFirstLevel['CHILD'] AS &$arSecondLevel){
                                        if ($arSecondLevel['CHILD'] && count($arSecondLevel['CHILD']) > 1) { ?>
                                            <ul class="main-submenu__list">
                                                <div class="main-submenu__title"><?=$arSecondLevel['TEXT']?></div>
                                                <? if ($arSecondLevel['CHILD']) { ?>
                                                    <ul class="main-nav__submenu">
                                                        <? foreach ($arSecondLevel['CHILD'] AS &$arThirdLevel) { ?>
                                                            <div class="main-submenu__item"><a class="main-submenu__link" href="<?=$arThirdLevel['ADDITIONAL_LINKS'][0]?>"><?=$arThirdLevel['TEXT']?></a></div>
                                                        <? } ?>
                                                    </ul>
                                                <? } ?>
                                            </ul>
                                        <? }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } else { ?>
                    <div class="main-nav__submenu-wrap">
                        <div class="main-nav__submenu">
                            <ul class="main-nav__submenu-box">
                                <? foreach ($arFirstLevel['CHILD'] as $arSecondLevel) { ?>
                                    <li class="main-nav__item"><a class="main-nav__link" href="<?=$arSecondLevel['ADDITIONAL_LINKS'][0]?>"><?=$arSecondLevel['TEXT']?></a></li>
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                <? } ?>
                <span class="link__arrow"></span>
            <? } ?>
        </li>
    <? } ?>
</ul>