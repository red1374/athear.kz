<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;
global $USER;

$APPLICATION->SetTitle('Мои заказы');

if (!$USER->IsAuthorized()) LocalRedirect('/');
?>
<?php $APPLICATION->IncludeComponent(
    "bitrix:sale.personal.order",
    ".default",
    array(
        "STATUS_COLOR_N" => "green",
        "STATUS_COLOR_P" => "yellow",
        "STATUS_COLOR_F" => "green",
        "STATUS_COLOR_PSEUDO_CANCELLED" => "red",
        "SEF_MODE" => "Y",
        "ORDERS_PER_PAGE" => "80",
        "PATH_TO_PAYMENT" => "",
        "PATH_TO_BASKET" => "/personal/cart/",
        "SET_TITLE" => "Y",
        "SAVE_IN_SESSION" => "N",
        "NAV_TEMPLATE" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "PROP_1" => array(),
        "PROP_2" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "CUSTOM_SELECT_PROPS" => array(),
        "HISTORIC_STATUSES" => array(
            0 => "F",
        ),
        "SEF_FOLDER" => "/personal/orders/",
        "COMPONENT_TEMPLATE" => ".default",
        "DETAIL_HIDE_USER_INFO" => array(
            0 => "0",
        ),
        "PATH_TO_CATALOG" => "/catalog/",
        "DISALLOW_CANCEL" => "Y",
        "RESTRICT_CHANGE_PAYSYSTEM" => array(
            0 => "0",
        ),
        "REFRESH_PRICES" => "N",
        "ORDER_DEFAULT_SORT" => "DATE_INSERT",
        "SEF_URL_TEMPLATES" => array(
            "list" => "/",
            "detail" => "#ID#/",
            "cancel" => "",
        ),
        "VARIABLE_ALIASES" => array(
            "detail" => array(
                "ID" => "ID",
            ),
        )
    ),
    false
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
