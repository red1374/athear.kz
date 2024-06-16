<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

    $this->setFrameMode(true);

    /**
     * @global $arResult
     */

    if (empty($arResult['ITEMS'])){
        return ;
    }
?>
<div class="map-content" id="<?=$arParams['MAP_ID']?>"></div>
<script>
var centersMap;
let placemarks = [];

<? if (!empty($arResult['ITEMS'])){
    foreach($arResult['ITEMS'] AS &$arItem):?>
placemarks.push({
    'NAME': '<?=$arItem['NAME']?>',
    'PHONE': '<?=$arItem['PHONE_VALUE']?>',
    'EMAIL': '<?=$arItem['EMAIL_VALUE']?>',
    'COORDS': [<?=$arItem['COORDS_VALUE']?>],
    'ADDRESS': '<?=$arItem['ADDRESS']?>',
    'SCHEDULE': '<?=$arItem['SCHEDULE']?>',
    'SHOW_SIGNIN': '<?=($arParams['SHOW_SIGNIN'] ? $arParams['SHOW_SIGNIN'] : 'N')?>',
});
<? endforeach;
}?>

try {
    window.addEventListener('DOMContentLoaded', () => {
        centersMap = new CMap(ymaps, '<?=$arParams['MAP_ID']?>', {
            'ZOOM': '<?=$arParams['MAP']['ZOOM']?>',
            'CENTER': [<?=join(',', $arParams['MAP']['CENTER'])?>]
        });
        if (placemarks.length){
            centersMap.addPlacemarks(placemarks);
        }
    });
} catch (e) {
    console.log(e);
}
</script>