<?php
    use Bitrix\Main\Context;
	require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

	$includePath= '/local/php_interface/include/components/';
	$isAjax     = ( (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
        $_REQUEST["AJAX_CALL"] == "Y");

	if (!$isAjax || !check_bitrix_sessid())
        die();

    $APPLICATION->RestartBuffer();
    $io = CBXVirtualIo::GetInstance();

    IncludeTemplateLangFile($_SERVER['DOCUMENT_ROOT'].CClass::HEADER_LANG_FILE_PATH);
    $form_name  = trim(strip_tags($_GET['f_name'])).'-form';
    if ($form_name && file_exists($io->SiteRelativeToAbsolutePath($includePath.'/forms/'.$form_name.'.php')))
        include($io->SiteRelativeToAbsolutePath($includePath.'/forms/'.$form_name.'.php', 's1'));
?>