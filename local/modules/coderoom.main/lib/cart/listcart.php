<?php

namespace Coderoom\Main\Cart;

use Bitrix\Currency\CurrencyManager;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Internals\BasketTable;
use Bitrix\Sale\Rest\Entity\BasketItem;
use \Bitrix\Iblock\Elements\ElementCatalogTable;

class ListCart
{
    protected $iFUser;
    protected $arFilter;

    public function __construct()
    {
        \CModule::IncludeModule('sale');
        \CModule::IncludeModule('currency');
        $this->iFUser = Fuser::getId();
        $this->arFilter = [
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

    public function getGeneralPrice(): string
    {
        $generalPrice = 0;

        $arItems = $this->getListItems();

        foreach ($arItems as $arItem)
        {
            $generalPrice += $arItem['GENERAL_PRICE'];
        }

        return number_format($generalPrice, 0, '', ' ');
    }

    public function getListIDS(): array
    {
        $arFilter['!DELAY'] = 'Y';
        return array_column(BasketTable::getList(['filter' => $this->arFilter + $arFilter])->fetchAll(), 'PRODUCT_ID', 'PRODUCT_ID');
    }

    public function getListItems(): array
    {
        $arItems = BasketTable::getList(['filter' => $this->arFilter,  'select' => ['ID', 'PRODUCT_ID', 'NAME', 'PRICE', 'QUANTITY', 'DETAIL_PAGE_URL', 'DELAY']])->fetchAll();

        foreach ($arItems as $key => $arItem)
        {
            foreach ($arItems as $secondKey => $arItemSecond)
            {
                if ($arItem['ID'] == $arItemSecond['ID']) continue;

                if ($arItem['PRODUCT_ID'] == $arItemSecond['PRODUCT_ID'])
                {
                    if (!$arItem['NAME']) continue; // если не избранное

                    $arItems[$key]['DELAY'] = $arItemSecond['DELAY'];

                    unset($arItems[$secondKey]);
                }
            }

            if (!$arItem['NAME'] && $arItem['DELAY'] == 'Y') {
                $show = true;

                foreach ($arItems as $arItemSecond)
                {
                    if ($arItem['PRODUCT_ID'] == $arItemSecond['PRODUCT_ID']) $show = false;
                }

                if (!$show)  unset($arItems[$key]);
            }
        }

        $arItemsPictures = ElementCatalogTable::getList([
            'select' => [
                'ID',
                'PREVIEW_PICTURE',
            ],
            'filter' => [
                '=ID' => $this->getListIDS(),
            ]
        ])->fetchAll();

        foreach ($arItems as $key => $arItem)
        {
            foreach ($arItemsPictures as $arItemPicture)
            {
                if ($arItem['PRODUCT_ID'] == $arItemPicture['ID'])
                {
                    $arItems[$key]['PREVIEW_PICTURE'] = $arItemPicture['PREVIEW_PICTURE'] ? \CFile::GetPath($arItemPicture['PREVIEW_PICTURE']) : '/local/templates/audiotech/images/no-photo.png';
                }
            }

            $arItems[$key]['GENERAL_PRICE'] = $arItem['PRICE'] * $arItem['QUANTITY'];
            $arItems[$key]['PRICE'] = $arItem['PRICE'];
        }

        return $arItems;
    }

    public function addByProductID(int $iProductID, int $iQuantity): void
    {
        $basket = Basket::loadItemsForFUser($this->iFUser, 's1');

        if ($basketItem = $basket->getExistsItem('catalog', $iProductID)) {
            $basketItem->setField('QUANTITY', $iQuantity);
        } else {
            $basketItem = $basket->createItem('catalog', $iProductID);

            $basketItem->setFields([
                'QUANTITY' => $iQuantity,
                'DELAY' => 'N',
                'CURRENCY' => CurrencyManager::getBaseCurrency(),
                'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
            ]);
        }

        $basket->save();
    }

    public function addProductsByIDs(array $arProductIDs, array $arQuantities) : string
    {
        foreach ($arProductIDs as $key => $iProductID)
        {
           $this->addByProductID($iProductID, $arQuantities[$key]);
        }
    }

    public function deleteByIdProduct(int $iProductID): void
    {
        $arItems = array_column(BasketTable::getList(['filter' => ['PRODUCT_ID' => $iProductID] + $this->arFilter])->fetchAll(), null, 'ID');

        foreach (array_keys($arItems) as $iID) {
            BasketTable::delete($iID);
        }
    }

    public function deleteAllProducts(): void
    {
        $arItems = array_column(BasketTable::getList(['filter' => $this->arFilter])->fetchAll(), null, 'ID');

        foreach (array_keys($arItems) as $iID) {
            BasketTable::delete($iID);
        }
    }
}