<?php
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
    $APPLICATION->SetTitle('Доставка');
?>
<section class="map">
    <div class="_container">
        <h2 class="title-page map__title"><?php $APPLICATION->ShowTitle(false); ?></h2>
    </div>
    <?php $APPLICATION->IncludeComponent(
        'coderoom:map',
        'delivery',
        [
            'IBLOCK_ID' => IB_PICKUP_ID,
            'MAP_ID'    => 'map-delivery',
            'ITEMS_COUNT'   => 2000,
            'FIELDS'    => [
                'COORDS_' => 'COORDS',
                'ADDRESS' => 'PREVIEW_TEXT',
                'SCHEDULE' => 'DETAIL_TEXT',
                'PHONE_' => 'PHONE',
                'INDEX_NEW_' => 'INDEX_NEW',
                'INDEX_' => 'INDEX',
            ],
            'MAP' => [
                'ZOOM'  =>  5,
                'CENTER'=> [49.420736, 69.386028],
            ]
        ]
    ); ?>
</section>
<?php $APPLICATION->IncludeComponent(
    'coderoom:customer.questions.section',
    '.default',
    [
        'SECTION_ID'    => 23,
        'QUESTIONS_URL' => '/customer/questions/',
        'BLOCK_TITLE'   => GetMessage('HDR_QUESTIONS_DELIVERY_TITLE'),
    ]
); ?>
<?php $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
