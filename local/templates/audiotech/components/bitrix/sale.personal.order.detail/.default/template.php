<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
        die();
    }

    /** @global CMain $APPLICATION */
    /** @var array $arParams */
    /** @var array $arResult */
    /** @var string $templateFolder */
    $arProductIDs   = [];
    $arProductQTY   = [];
?>
<section class="orders">
    <div class="_container">
        <h1 class="title-page"><?=GetMessage('SPO_ORDER_NUMBER')?><?=$arResult['ID']?></h1>
        <div class="orders__wrap">
            <div class="orders__content">
                <div class="orders__block">
                    <h3 class="title-block orders__title"><?=GetMessage('SPO_ORDER_STATUS')?></h3>
                    <div class="orders__status orders-status">
                        <div class="orders-status__states">
                        <? foreach($arResult['STATUSES'] AS $k => &$arItem):
                            $arStatus = $arResult['ORDER_STATUS'][$arItem['STATUS_ID']];
                        ?>
                                <div class="orders-status__tracking <?=!empty($arStatus) ? 'orders-status__tracking--completed' : ''?>">
                                    <div class="orders-status__state"><?=($k + 1)?></div>
                                    <div class="orders-status__block">
                                        <span><?=$arItem['NAME']?></span>
                                        <? if (!empty($arStatus)):?><span><?=$arStatus['DATE']?></span><?endif?>
                                    </div>
                                </div>
                        <? endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="orders__block">
                    <h3 class="title-block orders__title"><?=GetMessage('SPO_GOODS_LIST')?></h3>
                    <div class="table table--orders">
                        <table class="table__wrapper table__wrapper--resp">
                            <thead>
                            <tr>
                                <th><?=GetMessage('SPO_TABLE_NAME')?></th>
                                <th><?=GetMessage('SPO_TABLE_PRICE')?></th>
                                <th><?=GetMessage('SPO_TABLE_QTY')?></th>
                                <th><?=GetMessage('SPO_TABLE_SUM')?></th>
                            </tr>
                            </thead>
                            <tbody>
                        <? foreach($arResult['BASKET'] AS &$arItem) {
                                $arProductIDs[] = $arItem['PRODUCT_ID'];
                                $arProductQTY[] = $arItem['QUANTITY'];
                        ?>
                                <tr>
                                    <td>
                                        <span class="table__title-mobile"><?=GetMessage('SPO_TABLE_NAME')?></span>
                                        <span><?=$arItem['NAME']?></span>
                                    </td>
                                    <td>
                                        <span class="table__title-mobile"><?=GetMessage('SPO_TABLE_PRICE')?></span>
                                        <span><?=$arItem['PRICE_FORMATED']?></span>
                                    </td>
                                    <td>
                                        <span class="table__title-mobile"><?=GetMessage('SPO_TABLE_QTY')?></span>
                                        <span><?=$arItem['QUANTITY']?></span>
                                    </td>
                                    <td>
                                        <span class="table__title-mobile"><?=GetMessage('SPO_TABLE_SUM')?></span>
                                        <span><?=$arItem['FORMATED_SUM']?></span>
                                    </td>
                                </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="orders__block delivery-block">
                    <h3 class="title-block orders__title"><?=GetMessage('SPO_DELIVERY_AND_PAY')?></h3>
                    <div class="delivery-block__wrap">
                        <? if (!empty($arResult['SHIPMENT'])):?>
                        <div class="orders-block__col">
                            <h4 class="orders-block__title"><?=$arResult['DELIVERY']['NAME']?></h4>
                            <div class="delivery-block__status">
                                <span><?=GetMessage('SPO_STATUS')?></span>
                                <span class="success"><?=$arResult['SHIPMENT'][0]['STATUS_NAME']?></span>
                                <? if ($arResult['SHIPMENT'][0]['TRACKING_NUMBER']):
                                    $link = $arResult['SHIPMENT'][0]['DELIVERY_ID'] == DELIVERY_KAZPOST_ID ?
                                        'https://qazpost.kz/ru/tracking?trackNumber=' : '';
                                ?>
                                <a href="<?=$link.$arResult['SHIPMENT'][0]['TRACKING_NUMBER']?>" target="_blank"><?=GetMessage('SPO_CHECK_BY_TRACK_NUMBER')?></a>
                                <? endif?>
                            </div>
                        </div>
                        <? endif;
                        if (!empty($arResult['PAYMENT'])):?>
                        <div class="orders-block__col">
                            <h4 class="orders-block__title"><?=GetMessage('SPO_PAYMENT')?> <?=mb_strtolower($arResult['PAYMENT'][0]['PAY_SYSTEM_NAME'])?></h4>
                            <div class="delivery-block__status">
                                <span><?=GetMessage('SPO_STATUS')?></span>
                                <? if ($arResult['PAYMENT'][0]['PAID'] == 'Y'):?>
                                <span class="success"><?=GetMessage('SPO_PAYED')?></span><? else:?>
                                <span class="not-payed"><?=GetMessage('SPO_NOT_PAYED')?></span>
                                <? endif?>
                            </div>
                        </div>
                        <? endif?>
                    </div>
                    <? if ($arResult['ADDRESS']):?>
                    <?/*<div class="delivery-block__footer">
                        <span>Адрес</span><span><?=$arResult['ADDRESS']?></span>
                    </div>*/?>
                    <div class="delivery-block__wrap">
                        <div class="orders-block__col">
                            <div class="delivery-block__status">
                                <span><?=GetMessage('SPO_ADDRESS')?></span>
                                <span><?=$arResult['ADDRESS']?></span>
                            </div>
                        </div>
                    </div>
                    <? endif ?>
                </div>
                <div class="orders__block">
                    <h3 class="title-block orders__title"><?=GetMessage('SPO_USER_DATA')?></h3>
                    <h4 class="orders-block__title"><?=$arResult['FIO']?></h4>
                    <ul class="orders-block__list">
                    <? foreach($arResult['ORDER_PROPS'] AS &$arProp):
                        if (in_array($arProp['CODE'], ['PHONE', 'EMAIL']) && $arProp['VALUE']):?>
                        <li>
                            <label class="label"><?=$arProp['NAME']?></label>
                            <span><?=$arProp['VALUE']?></span>
                        </li>
                        <? endif;
                        endforeach?>
                    </ul>
                </div>
                <div class="orders__block">
                    <h3 class="title-block orders__title"><?=GetMessage('SPO_COMMENT')?></h3>
                    <textarea class="delivery-block__text"
                              disabled><?=$arResult['USER_DESCRIPTION']?></textarea>
                </div>
                <a class="btn btn--red btn--icn btn--l" href="/personal/orders/">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 18H20M4 6H20H4ZM4 10H20H4ZM4 14H20H4Z" stroke="white" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg><?=GetMessage('SPO_GO_TO_LIST')?></a>
            </div>
            <div class="aside-box">
                <h2 class="section-title"><?=GetMessage('SPO_YOUR_ORDER')?></h2>
                <ul class="aside-box__list">
                    <li class="aside-box__item">
                        <span class="aside-box__text"><?=GetMessage('SPO_ORDER_SUM')?></span>
                        <span class="aside-box__text"><?=$arResult['PRODUCT_SUM_FORMATED']?></span>
                    </li>
                    <li class="aside-box__item">
                        <span class="aside-box__text"><?=$arResult['DELIVERY']['NAME']?></span>
                        <span class="aside-box__text"><?=($arResult['SHIPMENT'][0]['PRICE_DELIVERY'] ?
                                $arResult['SHIPMENT'][0]['PRICE_DELIVERY_FORMATED'] :
                                GetMessage('SPO_DELIVERY_FREE'))?></span>
                    </li>
                    <li class="aside-box__item">
                        <span class="aside-box__text strong"><?=GetMessage('SPO_TOTAL')?></span>
                        <span class="aside-box__text strong"><?=$arResult['PRICE_FORMATED']?></span>
                    </li>
                </ul>
                <button class="btn btn--red btn--icn btn--l" onclick="addProductsToCart([<?=join(',', $arProductIDs)?>], [<?=join(',', $arProductQTY)?>])">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.919 15H15.5H19.919Z" fill="white"/>
                        <path d="M4.5 3.99999V8.99999H5.082M5.082 8.99999C5.74585 7.35812 6.93568 5.9829 8.46503 5.08985C9.99438 4.1968 11.7768 3.8364 13.533 4.06513C15.2891 4.29386 16.9198 5.09878 18.1694 6.35377C19.419 7.60875 20.2168 9.24285 20.438 11M5.082 8.99999H9.5M20.5 20V15H19.919M19.919 15C19.2542 16.6409 18.064 18.015 16.5348 18.9073C15.0056 19.7995 13.2237 20.1595 11.4681 19.9309C9.71246 19.7022 8.0822 18.8979 6.83253 17.6437C5.58287 16.3896 4.78435 14.7564 4.562 13M19.919 15H15.5"
                              stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg><?=GetMessage('SPO_REPEAT_ORDER')?>
                </button>
            </div>
        </div>
</section>
<?php
    $APPLICATION->AddChainItem(GetMessage('SPO_ORDER_NUMBER').$arResult['ACCOUNT_NUMBER']);
?>