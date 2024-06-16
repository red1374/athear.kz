<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Востановление пароля');
?>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/personal/",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => ""
	),
	false
);?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
