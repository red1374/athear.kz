<?php
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<section class="basket order">
    <div class="_container">
        <a class="order__back" href="/personal/cart/"><?=GetMessage('HDR_BACK_TO_BASKET')?></a>
        <h1 class="title-page"><?$APPLICATION->ShowTitle(true)?></h1>
        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax",
	".default",
	array(
		"ACTION_VARIABLE" => "soa-action",
		"ADDITIONAL_PICT_PROP_1" => "-",
		"ALLOW_APPEND_ORDER" => "Y",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BASKET_POSITION" => "before",
		"COMPATIBLE_MODE" => "Y",
		"DELIVERIES_PER_PAGE" => "9",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "H",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "Y",
		"EMPTY_BASKET_HINT_PATH" => "/catalog/",
		"HIDE_ORDER_DESCRIPTION" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "1",
		"PICKUP_MAP_TYPE" => "yandex",
		"PRODUCT_COLUMNS_HIDDEN" => array(
			0 => "PRICE_FORMATED",
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PRICE_FORMATED",
		),
		"PROPS_FADE_LIST_1" => array(
			0 => "2",
			1 => "3",
			2 => "4",
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"SET_TITLE" => "N",
		"SHOW_BASKET_HEADERS" => "Y",
		"SHOW_COUPONS" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "N",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "N",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "Y",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "always",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "N",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_VAT_PRICE" => "N",
		"SKIP_USELESS_BLOCK" => "Y",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "red",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "Y",
		"USE_CUSTOM_ERROR_MESSAGES" => "Y",
		"USE_CUSTOM_MAIN_MESSAGES" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PHONE_NORMALIZATION" => "Y",
		"USE_PRELOAD" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"MESS_AUTH_BLOCK_NAME" => "Авторизация",
		"MESS_REG_BLOCK_NAME" => "Регистрация",
		"MESS_BASKET_BLOCK_NAME" => "1. Состав заказа",
		"MESS_REGION_BLOCK_NAME" => "2. Регион доставки",
		"MESS_PAYMENT_BLOCK_NAME" => "4. Оплата",
		"MESS_DELIVERY_BLOCK_NAME" => "3. Доставка и самовывоз",
		"MESS_BUYER_BLOCK_NAME" => "5. Получатель",
		"MESS_BACK" => "Назад",
		"MESS_FURTHER" => "Далее",
		"MESS_EDIT" => "Изменить",
		"MESS_ORDER" => "Оформить заказ",
		"MESS_PRICE" => "Стоимость",
		"MESS_PERIOD" => "Срок доставки",
		"MESS_NAV_BACK" => "Назад",
		"MESS_NAV_FORWARD" => "Вперед",
		"MESS_PRICE_FREE" => "бесплатно",
		"MESS_ECONOMY" => "Экономия",
		"MESS_REGISTRATION_REFERENCE" => "Если вы впервые на сайте, и хотите, чтобы мы вас помнили и все ваши заказы сохранялись, заполните регистрационную форму.",
		"MESS_AUTH_REFERENCE_1" => "Символом \"звездочка\" (*) отмечены обязательные для заполнения поля.",
		"MESS_AUTH_REFERENCE_2" => "После регистрации вы получите информационное письмо.",
		"MESS_AUTH_REFERENCE_3" => "Личные сведения, полученные в распоряжение интернет-магазина при регистрации или каким-либо иным образом, не будут без разрешения пользователей передаваться третьим организациям и лицам за исключением ситуаций, когда этого требует закон или судебное решение.",
		"MESS_ADDITIONAL_PROPS" => "Дополнительные свойства",
		"MESS_USE_COUPON" => "Применить купон",
		"MESS_COUPON" => "Купон",
		"MESS_PERSON_TYPE" => "Тип плательщика",
		"MESS_SELECT_PROFILE" => "Выберите профиль",
		"MESS_REGION_REFERENCE" => "Выберите свой город в списке. Если вы не нашли свой город, выберите \"другое местоположение\", а город впишите в поле \"Город\"",
		"MESS_PICKUP_LIST" => "Пункты самовывоза:",
		"MESS_NEAREST_PICKUP_LIST" => "Ближайшие пункты:",
		"MESS_SELECT_PICKUP" => "Выбрать",
		"MESS_INNER_PS_BALANCE" => "На вашем пользовательском счете:",
		"MESS_ORDER_DESC" => "Комментарии к заказу:",
		"MESS_SUCCESS_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.\nЕсли все заполнено верно, нажмите кнопку \"#ORDER_BUTTON#\".",
		"MESS_FAIL_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.nОбратите внимание на развернутый блок с информацией о заказе. Здесь вы можете внести необходимые изменения или оставить как есть и нажать кнопку \"#ORDER_BUTTON#\".",
		"MESS_DELIVERY_CALC_ERROR_TITLE" => "Не удалось рассчитать стоимость доставки.",
		"MESS_DELIVERY_CALC_ERROR_TEXT" => "Вы можете продолжить оформление заказа, а чуть позже менеджер магазина свяжется с вами и уточнит информацию по доставке.",
		"MESS_PAY_SYSTEM_PAYABLE_ERROR" => "Вы сможете оплатить заказ после того, как менеджер проверит наличие полного комплекта товаров на складе. Сразу после проверки вы получите письмо с инструкциями по оплате. Оплатить заказ можно будет в персональном разделе сайта.",
		"SHOW_MAP_FOR_DELIVERIES" => ""
	),
	false
);?>
    </div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>