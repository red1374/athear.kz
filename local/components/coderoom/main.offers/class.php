<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementOffersTable;

class MainOffers extends \CBitrixComponent
{
    private $iCacheTime = 3600000;
    private $sCacheId = 'MainOffers';
    private $sCachePath = 'MainOffers/';

    public function executeComponent()
    {
        $obCache = new CPHPCache;

        if ($obCache->initCache($this->iCacheTime, $this->sCacheId, $this->sCachePath)) {
            $vars = $obCache->GetVars();

            $this->arResult = $vars['arResult'];
        } else if ($obCache->StartDataCache()) {
            $this->arResult['ITEMS'] = $this->getItems();

            $obCache->EndDataCache([
                'arResult' => $this->arResult,
            ]);
        }

        $this->includeComponentTemplate();
    }

    private function getItems ()
    {
        return ElementOffersTable::getList([
            'order' => [
                'SORT' => 'ASC'
            ],
            'select' => [
                'ID',
                'NAME',
                'IMAGE_' => 'IMAGE',
                'PREVIEW_TEXT',
                'BTN_ACTION_' => 'BTN_ACTION',
                'BTN_TEXT_' => 'BTN_TEXT'
            ],
            'filter' => [
                'ACTIVE' => 'Y'
            ]
        ])->fetchAll();
    }
}