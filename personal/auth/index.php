<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Авторизация');
?>
<?php // Форма авторизации - http://dev.1c-bitrix.ru/user_help/settings/users/components_2/system_auth_form.php
$APPLICATION->IncludeComponent(
	"bitrix:main.auth.form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"AUTH_FORGOT_PASSWORD_URL" => "getpassword.php",
		"AUTH_REGISTER_URL" => "registration.php",
		"AUTH_SUCCESS_URL" => "/personal/"
	),
	false
);?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
