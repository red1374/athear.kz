<?php
    if (!$_SERVER["DOCUMENT_ROOT"]){
        $_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/..");
        define("CRON_TASK", true);
    }
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    set_time_limit(0);

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    require($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/classes/CKAZPost.class.php");

    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);

    $KAZPost = new CKAZPost(IB_PICKUP_ID);
    $KAZPost->syncPostDeps();
    //var_dump($KAZPost->getStat());
