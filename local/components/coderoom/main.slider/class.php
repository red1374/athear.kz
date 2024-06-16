<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\Elements\ElementBannerTable;

class MainSlider extends \CBitrixComponent
{
    private $iCacheTime = 3600000;
    private $sCacheId = 'MainSlider';
    private $sCachePath = 'MainSlider/';

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

    private function getItems (){
        if ($this->arParams['SORT']){
            $direction = $this->arParams['ORDER'] ? $this->arParams['ORDER'] : 'ASC';
            $arOrder[$this->arParams['SORT']] = 'ASC';
        }else{
            $arOrder = [
                'SORT'  => 'ASC',
            ];
        }
        return ElementBannerTable::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_PICTURE',
                'LINK_' => 'LINK',
                'SUBTITLE_' => 'SUBTITLE',
                'BTN_TEXT_' => 'BTN_TEXT',
                'BANNER_MOBILE_' => 'BANNER_MOBILE'
            ],
            'filter'    => ['ACTIVE' => 'Y'],
            'order' => $arOrder,
        ])->fetchAll();
    }
}