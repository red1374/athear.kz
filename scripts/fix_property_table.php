<?php
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php
    if (!$USER->isAdmin()){
        die();
    }
    use \Bitrix\Iblock\Elements\ElementCatalogTable;
    $arItems = ElementCatalogTable::getList([
        'select' => [
            'ID',
        ],
    ])->fetchAll();
    $arIDs  = [];
    foreach($arItems AS &$arItem){
        $arIDs[] = $arItem['ID'];
    }

    if (empty($arIDs)){
        print '<p>Товары не найдены!<p>';
        return "";
    }
    print '<p>Всего товаров: '.count($arIDs).'<p>';

    // -- Deleting old properties values ------------------------------------ //
    $arOldValues = '';
    $q = "DELETE FROM b_iblock_element_property WHERE IBLOCK_ELEMENT_ID IN (".join(',', $arIDs).")";
    $res = $DB->query($q);

    // -- Getting property values from recovering table --------------------- //
    $q = "SELECT * FROM b_iblock_element_property_new WHERE IBLOCK_ELEMENT_ID IN (".join(',', $arIDs).")";
    $res = $DB->query($q);

    // -- Adding new property values to current property values table ------- //
    $arFields = [
        'IBLOCK_PROPERTY_ID', 'IBLOCK_ELEMENT_ID', 'VALUE', 'VALUE_TYPE',
        'VALUE_ENUM', 'VALUE_NUM', 'DESCRIPTION',
    ];
    $q = "INSERT INTO b_iblock_element_property SET ";
    $count = 0;
    while($arItem = $res->fetch()){
        $arQuery = [];
        foreach($arFields AS &$field_code){
            $arQuery[] = "$field_code='{$arItem[$field_code]}'";
        }
        $DB->query($q.join(', ', $arQuery));
        $count++;
    }
    print "<p>Добавлено свойств: ".$count."</p>";
