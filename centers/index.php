<?php
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
    $APPLICATION->SetTitle('Центры слуха');
    $APPLICATION->AddChainItem('Центры слуха', '/centers/');
?>
<section class="map">
    <div class="_container">
        <div class="map__title">
            <h1 class="title-page"><? $APPLICATION->ShowTitle(false)?></h1>
            <?/*<div class="map__change">
                <select class="mySelect">
                    <option value="">Алматы</option>
                </select>
            </div>*/?>
        </div>
        <?php $APPLICATION->IncludeComponent(
            'coderoom:map',
            'centers',
            [
                'IBLOCK_ID' => IB_CENTERS_ID,
                'MAP_ID'    => 'map-centers',
                'ITEMS_COUNT'   => 2000,
                'FIELDS'    => [
                    'COORDS_' => 'COORDS',
                    'ADDRESS' => 'PREVIEW_TEXT',
                    'SCHEDULE' => 'DETAIL_TEXT',
                    'PHONE_' => 'PHONE',
                    'EMAIL_' => 'EMAIL',
                ],
                'MAP' => [
                    'ZOOM'  =>  12,
                    'CENTER'=> [43.261239351436, 76.945625480986],
                ],
                'SHOW_SIGNIN' => 'Y',
            ]
        ); ?>
    </div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>