<?php

namespace Coderoom\Main\Controllers;

use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Coderoom\Main\Order\CreateOrder;
use PhpImap\Exception;
use Bitrix\Main\Localization\Loc;

class Order extends Controller
{

    public function configureActions()
    {
        return [
            'create' => ['prefilters' => [new Csrf()]],
        ];
    }

    public function createAction(array $array)
    {
        $obOrder = new CreateOrder;
        return $obOrder->createOrder($array);
    }
}