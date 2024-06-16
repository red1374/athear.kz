<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Order;
use \Bitrix\Sale\Basket;
use Bitrix\Sale\Delivery\Services\Table;

global $APPLICATION;
global $USER;

$request = Context::getCurrent()->getRequest();
$locationID = $request->get('locationID');
$FUSER_TYPE_ID = 1;

if (!empty($locationID)) {
    $arIDs = [];

    $siteId = Context::getCurrent()->getSite();
    $basket = Basket::loadItemsForFUser(Fuser::getId(), $siteId);

    $order = Order::create($siteId, $USER->isAuthorized() ? $USER->GetID() : Fuser::getId());
    $order->setPersonTypeId($FUSER_TYPE_ID);
    $order->setBasket($basket);

    $propertyCollection = $order->getPropertyCollection();
    $propertyLocation = $propertyCollection->getDeliveryLocation();
    $propertyLocation->setField('VALUE', CSaleLocation::getLocationCODEbyID($locationID));

    $shipmentCollection = $order->getShipmentCollection();
    $shipment = $shipmentCollection->createItem();
    $shipmentItemCollection = $shipment->getShipmentItemCollection();
    $shipment->setField('CURRENCY', $order->getCurrency());

    $deliveryIds = [];

    foreach ($order->getBasket() as $item) {
        $shipmentItem = $shipmentItemCollection->createItem($item);
        $shipmentItem->setQuantity($item->getQuantity());

        $arrDelideriyList = \Bitrix\Sale\Delivery\Services\Manager::getRestrictedObjectsList($shipment, \Bitrix\Sale\Services\Base\RestrictionManager::MODE_CLIENT);

        $shipmentItem->delete();

        $deliveryIds = array_unique(array_merge($deliveryIds, array_keys($arrDelideriyList)));
    }

    $arDeliveries = Table::getList([
        'order' => [
            'SORT' => 'DESC',
        ],
        'filter' => [
            'ACTIVE' => 'Y',
            'ID' => $deliveryIds,
        ],
    ])->fetchAll();
    ?>
    <div class="order__title-delivery methods">Способ доставки</div>

    <div class="order__methods delivery">
        <?php foreach ($arDeliveries as $arDelivery) { ?>
            <label for="delivery_<?php echo $arDelivery['ID']; ?>" class="order__method method">
                <input type="radio" name="DELIVERY" class="radio" value="<?php echo $arDelivery['NAME']; ?>"
                       id="delivery_<?php echo $arDelivery['ID']; ?>">
                <span class="method__name"><?php echo $arDelivery['NAME']; ?></span>
                <span class="method__radio"></span>
                <span class="method__price"><?php echo $arDelivery['DESCRIPTION']; ?></span>
            </label>
        <?php } ?>
    </div>
    <?php
}
?>
