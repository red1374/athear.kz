<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    use Bitrix\Main\Context;
    use Bitrix\Sale;
    use Bitrix\Currency\CurrencyManager;

    $request = Context::getCurrent()->getRequest();
    $productId = $request->get('id');
    $quantity = $request->get('quantity');
    //$event = $request->get('event');

    $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Context::getCurrent()->getSite());

    if ($item = $basket->getExistsItem('catalog', $productId)) {
        $item->setField('QUANTITY', $quantity);
    }
    else {
        $item = $basket->createItem('catalog', $productId);
        $item->setFields([
            'QUANTITY' => $quantity,
            'CURRENCY' => CurrencyManager::getBaseCurrency(),
            'LID' => Context::getCurrent()->getSite(),
            'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        ]);
    }
    $basket->save();

    // -- Get basket items count -------------------------------------------- //
    $countBasketItems = CSaleBasket::GetList(
        [],
        [
            'FUSER_ID' => CSaleBasket::GetBasketUserID(),
            'LID' => SITE_ID,
            'ORDER_ID' => 'NULL',
            '!DELAY' => 'Y'
        ],
        []
    );

    CClass::Instance()->RenderJSON([
        'status'    => 'success',
        'count'     => $countBasketItems,
    ]);
