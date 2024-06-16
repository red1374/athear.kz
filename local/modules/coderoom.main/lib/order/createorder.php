<?php

namespace Coderoom\Main\Order;

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\Fuser,
    Bitrix\Sale\PersonType,
    Bitrix\Main\Security\Random;

class CreateOrder
{
    public function createOrder (array $array)
    {
        global $USER;

        $sFirstName = $array['FIRST_NAME'];
        $sLastName = $array['LAST_NAME'];
        $sFioName = $array['FIO'];
        $sPhone = $array['PHONE'];
        $sEmail = $array['EMAIL'];
        $sCity = $array['CITY'];
        $sLocation = $array['LOCATION'];
        $sDate = $array['DATE'];
        $sMessage = $array['MESSAGE'];
        $iDelivery = $array['DELIVERY'];
        $iPay = $array['PAY'];

        $siteId = Context::getCurrent()->getSite();
        $personType = PersonType::load($siteId);

        if (!$USER->isAuthorized()) {
            $obUser = new \CUser;

            $sPassword = Random::getString(10);

            $arUserFields = [
                'NAME'              => $sFirstName,
                'LAST_NAME'         => $sLastName,
                'EMAIL'             => $sEmail,
                'LOGIN'             => $sEmail,
                'ACTIVE'            => 'Y',
                'PASSWORD'          => $sPassword,
                'CONFIRM_PASSWORD'  => $sPassword,
            ];

            $userID = $obUser->Add($arUserFields);
            $USER->Authorize($userID);
        } else {
            $userID = $USER->GetID();
        }

        $order = Order::create($siteId, $userID);
        $order->setPersonTypeId($personType);

        $basket = Basket::loadItemsForFUser(Fuser::getId(), $siteId)->getOrderableItems();
        $order->setBasket($basket);

        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        foreach($order->getBasket() as $item) {
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());
        }

        $service = Delivery\Services\Manager::getById($iDelivery);
        $shipment->setFields([
            'DELIVERY_ID' => $service['ID'],
            'DELIVERY_NAME' => $service['NAME'],
            'CURRENCY' => $order->getCurrency(),
        ]);

        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        foreach ($order->getBasket() as $item) {
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());
        }

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystemService = PaySystem\Manager::getObjectById($iPay);
        $payment->setFields(array(
            'PAY_SYSTEM_ID' => $paySystemService->getField('PAY_SYSTEM_ID'),
            'PAY_SYSTEM_NAME' => $paySystemService->getField('NAME'),
        ));

        $order->doFinalAction(true);

        function getPropertyByCode($propertyCollection, $code) {
            foreach($propertyCollection as $property) {
                if ($property->getField("CODE") == $code)
                    return $property;
            }
        }

        $propertyCollection = $order->getPropertyCollection();

        $nameProperty = getPropertyByCode($propertyCollection, 'NAME');
        $nameProperty->setValue($sFioName);

        $phoneProperty = getPropertyByCode($propertyCollection, 'PHONE');
        $phoneProperty->setValue($sPhone);

        $emailProperty = getPropertyByCode($propertyCollection, 'MAIL');
        $emailProperty->setValue($sEmail);

        $cityProperty = getPropertyByCode($propertyCollection, 'CITY');
        $cityProperty->setValue($sCity);

        $locationProperty = getPropertyByCode($propertyCollection, 'LOCATION');
        $locationProperty->setValue($sLocation);

        $dateProperty = getPropertyByCode($propertyCollection, 'DATE');
        $dateProperty->setValue($sDate);

        $payment->setField('CURRENCY', $order->getCurrency());
        $order->setField('USER_DESCRIPTION', $sMessage);

        $result = $order->save();
        $orderId = $order->getId();

        return 'ok';
    }
}