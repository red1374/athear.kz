<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

 if (!empty($arResult["ITEMS"])){
    foreach($arResult["ITEMS"] AS &$arItem){
        $arItem["RESIZED"] = CFile::ResizeImageGet(
            $arItem["PREVIEW_PICTURE"],
            [
                'width' => 295,
                'height'=> 225,
            ],
            BX_RESIZE_IMAGE_EXACT,
            true
        );
    }
 }