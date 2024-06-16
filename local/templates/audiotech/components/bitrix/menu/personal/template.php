<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 */
$this->setFrameMode(true);
if (!empty($arResult)) {
    foreach($arResult AS &$arItem){
        $class = $arItem['SELECTED'] ? ' active' : '';
        if (!$USER->isAuthorized()){
            $class .= ' entry';
            $arItem['LINK'] = "#";
        }
    ?><a class="tabs__btn<?=$class?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a><?
    }
}?>
<? if ($USER->isAuthorized()):?>
<a class="personal__exit" href="/?logout=yes&<?=bitrix_sessid_get(); ?>"><?=GetMessage('HDR_EXIT')?></a>
<? else:?>
<a class="personal__exit entry" href="#"><?=GetMessage('HDR_ENTER')?></a>
<? endif?>