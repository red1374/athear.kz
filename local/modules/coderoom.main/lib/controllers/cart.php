<?php

namespace Coderoom\Main\Controllers;

use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Coderoom\Main\Cart\ListCart;
use PhpImap\Exception;
use Bitrix\Main\Localization\Loc;

class Cart extends Controller
{

    public function configureActions()
    {
        return [
            'add' => ['prefilters' => [new Csrf()]],
            'repeat' => ['prefilters' => [new Csrf()]],
            'delete' => ['prefilters' => [new Csrf()]],
            'get' => ['prefilters' => [new Csrf()]],
        ];
    }

    public function addAction(int $iProductID, int $iQuantity)
    {
        $obCartList = new ListCart;
        $obCartList->addByProductID($iProductID, $iQuantity);
    }

    public function repeatAction(array $arProductIDs, array $arQuantities)
    {
        $obCartList = new ListCart;
        $obCartList->addProductsByIDs($arProductIDs, $arQuantities);
    }

    public function deleteAction(int $iProductID)
    {
        $obCartList = new ListCart;
        $obCartList->deleteByIdProduct($iProductID);
    }

    public function getAction(): string
    {
        $obCartList = new ListCart;
        return $obCartList->getGeneralPrice();
    }
}