<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('О нас');
?>
    <section class="about">
        <div class="_container">
            <h1 class="title-page"><?php $APPLICATION->ShowTitle(false); ?></h1>
        </div>
        <div class="_container _container--mode">
            <div class="tabs">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top-second",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "360000",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "ROOT_MENU_TYPE" => "top-second",
                        "USE_EXT" => "N"
                    )
                );?>
                <div class="tabs__content">
                    <div class="tabs__pane show">
                        <div class="tabs__pane-wrap">
                            <h2 class="section-title">Центры слуха Audiotech</h2>
                            <p class="tabs__par tabs__par--container strong"><?php $APPLICATION->IncludeFile("/include/about-text-1.php", [], ["MODE" => "html"]); ?></p>
                            <div class="about__text"><?php $APPLICATION->IncludeFile("/include/about-text-2.php", [], ["MODE" => "html"]); ?></div>
                            <div class="about-cifrus">
                                <h2 class="section-title section-title--w">Мы в цифрах</h2>
                                <div class="about-cifrus__wrap">
                                    <ul class="about-cifrus__list">
                                        <?php $APPLICATION->IncludeFile("/include/about.php", [], ["MODE" => "html"]); ?>
                                    </ul>
                                    <?php $APPLICATION->IncludeFile("/include/about-video.php", [], ["MODE" => "html"]); ?>
                                </div>
                            </div>
                            <div class="map">
                                <h2 class="section-title map__title"> <span>Центры слуха Audiotech</span></h2>
                                <div class="map-content map-content--about">
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
                                                'ZOOM'  =>  14,
                                                'CENTER'=> [43.261239351436, 76.945625480986],
                                            ]
                                        ]
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $APPLICATION->IncludeComponent(
        'coderoom:main.offers',
        '.default',
        []
    ); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
