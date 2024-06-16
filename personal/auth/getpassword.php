<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Востановление пароля');
?>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:main.auth.forgotpasswd", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"AUTH_AUTH_URL" => "",
		"AUTH_REGISTER_URL" => "registration.php"
	),
	false
);?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
