<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if ($arResult["DETAIL_PICTURE"]){
    $arResult['RESIZED'] = CFile::ResizeImageGet(
        $arResult["DETAIL_PICTURE"],
        [
            'width' => 925,
            'height'=> 500,
        ],
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
}