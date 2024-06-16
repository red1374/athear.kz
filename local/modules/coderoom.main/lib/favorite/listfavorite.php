<?php

namespace Coderoom\Main\Favorite;

use Bitrix\Currency\CurrencyManager;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Internals\BasketTable;
use Bitrix\Sale\Rest\Entity\BasketItem;

class ListFavorite
{
    protected $iFUser;
    protected $arFilter;

    public function __construct()
    {
        global $USER;

        \CModule::IncludeModule('sale');
        \CModule::IncludeModule('currency');
        $this->iFUser = Fuser::getId();
        $this->arFilter = [
            'DELAY' => 'Y',
            'FUSER_ID' => $this->iFUser,
            'LID' => 's1',
            'MODULE' => 'catalog',
            'ORDER_ID' => 'NULL'
        ];
    }

    public function getCount(): int
    {
        return count($this->getListIDS());
    }

    public function getListIDS(): array
    {
        return array_column(BasketTable::getList(['filter' => $this->arFilter])->fetchAll(), 'PRODUCT_ID', 'PRODUCT_ID');
    }

    public function addByProductID(int $iProductID): void
    {
        $basket = Basket::loadItemsForFUser($this->iFUser, 's1');
        $basketItem = $basket->createItem('catalog', $iProductID);
        $basketItem->setFields([
            'DELAY' => 'Y',
            'QUANTITY' => 1,
            'CURRENCY' => CurrencyManager::getBaseCurrency(),
        ]);
        $basket->save();
    }

    public function deleteByIdProduct(int $iProductID): void
    {
        $arItems = array_column(BasketTable::getList(['filter' => ['PRODUCT_ID' => $iProductID] + $this->arFilter])->fetchAll(), null, 'ID');
        foreach (array_keys($arItems) as $iID) {
            BasketTable::delete($iID);
        }
    }

    public function deleteAll(): void
    {
        $arItems = array_column(BasketTable::getList(['filter' => $this->arFilter])->fetchAll(), null, 'ID');
        foreach (array_keys($arItems) as $iID) {
            BasketTable::delete($iID);
        }
    }
}