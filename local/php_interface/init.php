<?php
    use \Bitrix\Main\Loader;

    CModule::AddAutoloadClasses (
        '',
        [
            "CCache"        => "/local/php_interface/classes/CCache.class.php",
            "CClass"        => "/local/php_interface/classes/CClass.class.php",
            "CEventHandler" => "/local/php_interface/classes/CEventHandler.class.php",
            "CCustomCatalog"=> "/local/php_interface/classes/CCatalog.class.php",
        ]
    );

    define('IB_SUBSCRIBE_FORM_ID', 19);
    define('IB_QUESTION_FORM_ID', 20);
    define('IB_CATALOG_ID', 1);
    define('IB_PICKUP_ID', 25);
    define('IB_CENTERS_ID', 21);
    define('DELIVERY_KAZPOST_ID', 5);
    define('DELIVERY_SELFPICKUP_ID', 7);

    AddEventHandler("main", "OnEndBufferContent", ["CEventHandler", "OnEndBufferContent"]);

    AddEventHandler("iblock",   "OnBeforeIBlockElementAdd", ["CEventHandler", "onBeforeIBlockElementAdd"]);
    AddEventHandler("iblock",   "OnBeforeIBlockElementUpdate", ["CEventHandler", "onBeforeIBlockElementUpdate"]);
    AddEventHandler("iblock",   "OnAfterIBlockElementAdd",  ["CEventHandler", "onAfterIBlockElementAdd"]);

    Loader::IncludeModule('sale');
    Loader::IncludeModule('coderoom.main');

    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","DoNotUpdate");
    function DoNotUpdate(&$arFields){
        if ($_REQUEST['mode'] == 'import') {
            unset($arFields['ACTIVE']);
            unset($arFields['PREVIEW_TEXT']);
            unset($arFields['DETAIL_TEXT']);
            unset($arFields['DETAIL_TEXT_TYPE']);
            unset($arFields['PREVIEW_TEXT_TYPE']);
        }
    }

    AddEventHandler("iblock", "OnBeforeIBlockElementAdd","DoNotAdd");
    function DoNotAdd(&$arFields){
        if ($_REQUEST['mode'] == 'import') {
            unset($arFields['ACTIVE']);
            unset($arFields['PREVIEW_TEXT']);
            unset($arFields['DETAIL_TEXT']);
            unset($arFields['DETAIL_TEXT_TYPE']);
            unset($arFields['PREVIEW_TEXT_TYPE']);
        }
    }