<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$from = strtotime($_GET['from']);
$to = strtotime($_GET['to']);
?>
<section class="personal">
    <div class="_container">
        <h1 class="title-page"><?=$APPLICATION->ShowTitle(false)?></h1>
    </div>
    <div class="_container _container--mode">
        <div class="tabs">
            <div class="tabs-wrap">
                <div class="tabs__nav tabs__nav--personal">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "personal",
                        array(
                            "COMPONENT_TEMPLATE" => "personal",
                            "ROOT_MENU_TYPE" => "personal",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_CACHE_GET_VARS" => [],
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false
                    )?>
                </div>
            </div>
            <div class="tabs__content">
                <div class="tabs__pane show">
                    <div class="tabs__pane-wrap">

                    </div>
                    <div class="tabs__pane show">
                        <div class="personal__cal">
                            <div class="personal__cal-block">
                                <label class="label" for="">Дата заказа с</label>
                                <div class="input--dp">
                                    <input class="input" id="airpicker2" placeholder="дд.мм.гг" autocomplete="off"
                                           value="<?=$_GET['from']?>">
                                </div>
                            </div>
                            <div class="personal__cal-block">
                                <label class="label" for="">Дата заказа по</label>
                                <div class="input--dp">
                                    <input class="input" id="airpicker3" placeholder="дд.мм.гг" autocomplete="off"
                                           value="<?=$_GET['to']?>">
                                </div>
                            </div>
                        </div>
                        <div class="table table--personal">
                            <? if ($arResult['ORDERS']) { ?>
                                <table class="table__wrapper orders-tab">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Дата</th>
                                        <th>Товары</th>
                                        <th>Сумма</th>
                                        <th>Доставка</th>
                                        <th>Общая стоимость</th>
                                        <th>Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <? foreach($arResult['ORDERS'] AS &$arOrder) {
                                        $orderDate = $arOrder['ORDER']['DATE_INSERT']->getTimestamp();

                                        if ( ($from && $from > $orderDate) ||
                                                ($to && $to < $orderDate)
                                        ){
                                            continue;
                                        }?>
                                        <tr onclick="window.location = `<?=$arOrder['ORDER']['URL_TO_DETAIL']?>`">
                                            <td><?=$arOrder['ORDER']['ACCOUNT_NUMBER']?></td>
                                            <td><?=$arOrder['ORDER']['DATE_INSERT_FORMATED']?></td>
                                            <td><?=count($arOrder['BASKET_ITEMS'])?> шт</td>
                                            <td><?=((int)$arOrder['ORDER']['PRICE_DELIVERY'] ?
                                                    CurrencyFormat(
                                                        $arOrder['ORDER']['PRICE'] - (float)$arOrder['ORDER']['PRICE_DELIVERY'],
                                                        $arOrder['ORDER']['CURRENCY']) :
                                                    $arOrder['ORDER']['FORMATED_PRICE']
                                                )?></td>
                                            <td>
                                                <span><?=$arOrder['SHIPMENT'][0]['DELIVERY_NAME']?></span>
                                                <span><?=((int)$arOrder['ORDER']['PRICE_DELIVERY'] ?
                                                    CurrencyFormat($arOrder['ORDER']['PRICE_DELIVERY'], $arOrder['ORDER']['CURRENCY']) :
                                                    GetMessage('SPO_DELIVERY_FREE'))?></span>
                                            </td>
                                            <td><?=$arOrder['ORDER']['FORMATED_PRICE']?></td>
                                            <td><?=$arResult['INFO']['STATUS'][$arOrder['ORDER']['STATUS_ID']]['NAME']?></td>
                                        </tr>
                                    <? } ?>
                                    </tbody>
                                </table>
                            <? } else { ?>
                                У вас еще нет заказов.
                            <? } ?>
                        </div>
                        <? if (count($arResult['ORDERS']) > 8) { ?>
                            <div class="pagination">
                                <?= $arResult["NAV_STRING"]?>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
