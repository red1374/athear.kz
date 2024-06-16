<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Iblock\SectionTable;

class NewsTitle extends \CBitrixComponent
{
    public function executeComponent()
    {
        $this->setSectionName();
        $this->includeComponentTemplate();
    }

    private function setSectionName ()
    {
        global $APPLICATION;

         $arSection = SectionTable::getList([
            'select' => [
                'ID',
                'NAME',
            ],
            'filter' => [
                '=CODE' => $this->arParams["SECTION_CODE"],
            ],
        ])->fetchAll();

        $APPLICATION->SetTitle($arSection[0]['NAME']);
    }
}