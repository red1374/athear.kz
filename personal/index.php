<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Личный кабинет');

global $USER;

if (!$USER->IsAuthorized()) LocalRedirect('/');
?>

<section class="personal">
    <div class="_container">
        <h1 class="title-page"><?$APPLICATION->ShowTitle(false)?></h1>
    </div>
    <div class="_container _container--mode">
        <div class="tabs">
            <div class="tabs-wrap">
                <div class="tabs__nav tabs__nav--personal">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "personal",
                        array(
                            "COMPONENT_TEMPLATE" => "personal",
                            "ROOT_MENU_TYPE" => "personal",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_CACHE_GET_VARS" => [],
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="tabs__content">
                <div class="tabs__pane show">
                    <?=$APPLICATION->IncludeComponent(
                        'coderoom:personal',
                        '.default',
                        []
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
