<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

    $arResult['SELFPICKUPS'] = \Bitrix\Iblock\Elements\ElementSelfPickupTable::getList([
        'select'    => ['ID', 'NAME',
            'ADDRESS_' => 'ADDRESS', 'COORDS_' => 'COORDS', 'SCHEDULE_' => 'TIME',
            'PAY_' => 'PAY',
        ],
        'filter'    => ['ACTIVE' => 'Y'],
    ])->fetchAll();
