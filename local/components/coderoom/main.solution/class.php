<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementSolutionTable;

class MainSolution extends \CBitrixComponent
{
    private $iCacheTime = 3600000;
    private $sCacheId = 'MainSolution';
    private $sCachePath = 'MainSolution/';

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
        return ElementSolutionTable::getList([
            'select' => [
                'ID',
                'NAME',
                'LINK_' => 'LINK',
                'PREVIEW_PICTURE',
                'SUBTITLE_' => 'SUBTITLE',
            ],
        ])->fetchAll();
    }
}