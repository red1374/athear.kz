<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementQuestionsTable;

class CustomerGuaranteePay extends \CBitrixComponent
{
    private $iGuaranteeSectionID = 24;
    private $iCacheTime = 3600000;
    private $sCacheId = 'CustomerQuestionsPay';
    private $sCachePath = 'CustomerQuestionsPay/';

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
        return ElementQuestionsTable::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_TEXT',
            ],
            'filter' => [
                '=IBLOCK_SECTION_ID' => $this->iGuaranteeSectionID,
            ]
        ])->fetchAll();
    }
}