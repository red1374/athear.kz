<?php

namespace Coderoom\Main\Controllers;

use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use PhpImap\Exception;
use Bitrix\Main\Localization\Loc;
use Coderoom\Main\Favorite\ListFavorite;

class Favorite extends Controller
{

    public function configureActions()
    {
        return [
            'add' => ['prefilters' => [new Csrf()]],
            'delete' => ['prefilters' => [new Csrf()]],
            'deleteAll' => ['prefilters' => [new Csrf()]],
            'get' => ['prefilters' => [new Csrf()]],
        ];
    }

    public function addAction(int $iProductID)
    {
        $obFavoriteList = new ListFavorite;
        $obFavoriteList->addByProductID($iProductID);
    }

    public function deleteAction(int $iProductID)
    {
        $obFavoriteList = new ListFavorite;
        $obFavoriteList->deleteByIdProduct($iProductID);
    }

    public function deleteAllAction()
    {
        $obFavoriteList = new ListFavorite;
        $obFavoriteList->deleteAll();
    }

    public function getAction(): array
    {
        $obFavoriteList = new ListFavorite;
        return $obFavoriteList->getListIDS();
    }
}