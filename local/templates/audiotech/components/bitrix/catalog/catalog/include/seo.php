<?php
if (isset($_GET['PAGEN_1']) || isset($_GET['PAGEN_2'])){
    $template = "Страница ".(int)($_GET['PAGEN_2'] ? $_GET['PAGEN_2'] : $_GET['PAGEN_1'])." - ";
    $title = $APPLICATION->GetPageProperty('new_title') ? $APPLICATION->GetPageProperty('new_title') : $APPLICATION->GetTitle();
    $description = $APPLICATION->GetPageProperty('description') ? $APPLICATION->GetPageProperty('description') : $APPLICATION->GetDirProperty('description');
    //$APPLICATION->SetTitle($template.$title);

    $APPLICATION->SetPageProperty('new_title', $template.$title);
    $APPLICATION->SetPageProperty('description', $template.$description);
    $GLOBALS['H1'] = $title.$template;
    $APPLICATION->AddHeadString('<meta name="robots" content="noindex, follow"/>');
}
