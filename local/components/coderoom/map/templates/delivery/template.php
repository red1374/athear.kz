<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

    $this->setFrameMode(true);

    /**
     * @global $arResult
     */

    if (empty($arResult['ITEMS']) && empty($arResult['SELFPICKUPS'])){
        return ;
    }
?>
<div class="chips">
    <div class="_container">
        <div class="chips__inner">
            <button class="chips__item active active-tab" data-code="DEPS">Казпочта</button>
            <?/*<button class="chips__item" href="">СДЭК</button>
            <button class="chips__item" href="">Boxberry</button>*/?>
            <button class="chips__item" data-code="SELF">Склад самовывоза</button>
        </div>
    </div>
</div>
<div class="_container">
    <div class="map-content" id="<?=$arParams['MAP_ID']?>"></div>
</div>
<script>
var deliveryMap;
let placemarks = {
    'SELF': [],
    'DEPS': [],
};

<? if (!empty($arResult['ITEMS'])){
    foreach($arResult['ITEMS'] AS &$arItem):?>
placemarks['DEPS'].push({
    'NAME': '<?=$arItem['NAME']?>',
    'INDEX': '<?=$arItem['INDEX_VALUE']?>',
    'INDEX_NEW': '<?=$arItem['INDEX_NEW_VALUE']?>',
    'COORDS': [<?=$arItem['COORDS_VALUE']?>],
    'ADDRESS': '<?=$arItem['ADDRESS']?>',
    'SCHEDULE': '<?=$arItem['SCHEDULE']?>',
    'DELIVERY': '<?=GetMessage('CT_DELIVERY_COAST')?>',
});
<? endforeach;
}
if (!empty($arResult['SELFPICKUPS'])){
    foreach($arResult['SELFPICKUPS'] AS &$arItem):
?>
placemarks['SELF'].push({
    'NAME': '<?=$arItem['NAME']?>',
    'COORDS': [<?=$arItem['COORDS_VALUE']?>],
    'ADDRESS': '<?=$arItem['ADDRESS_VALUE']?>',
    'SCHEDULE': '<?=$arItem['SCHEDULE_VALUE']?>',
    'PAYMENT': '<?=$arItem['PAY_VALUE']?>',
    'DELIVERY': '<?=GetMessage('CT_DELIVERY_FREE')?>',
    'DELIVERY_LABEL': '<?=GetMessage('CT_DELIVERY_SELFPICKUP')?>',
});
<? endforeach;
}?>

try {
    window.addEventListener('DOMContentLoaded', () => {
        deliveryMap = new CMap(ymaps, '<?=$arParams['MAP_ID']?>', {
            'ZOOM': '<?=$arParams['MAP']['ZOOM']?>',
            'CENTER': [<?=join(',', $arParams['MAP']['CENTER'])?>]
        });
        let tabs = new SwitchTabs(deliveryMap, placemarks, {
            'DEPS': {'COORDS' : [<?=join(',', $arParams['MAP']['CENTER'])?>], 'ZOOM' : '<?=$arParams['MAP']['ZOOM']?>'},
            'SELF': {'COORDS' : [43.261239351436, 76.945625480986], 'ZOOM' : 15},
        });

        if (placemarks['DEPS'].length){
            deliveryMap.addPlacemarks(placemarks['DEPS']);
        }
    });
} catch (e) {
    console.log(e);
}
</script>