<?
IncludeModuleLangFile(__FILE__);

if(class_exists("coderoom_main"))
	return;

Class coderoom_main extends CModule
{
	var $MODULE_ID = 'coderoom.main';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
		var $errors;

	public function __construct()
	{
		$arModuleVersion = array();

		include(__DIR__."/version.php");
		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}

		$this->MODULE_NAME = 'Coderoom модуль';
		$this->MODULE_DESCRIPTION = 'Coderoom модуль';
	}

    function DoInstall()
    {
        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
    }

    function DoUninstall()
    {
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }

}