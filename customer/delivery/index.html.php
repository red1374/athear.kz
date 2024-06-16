<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Доставка');
$APPLICATION->AddChainItem('Покупателям', '/customer/');
$APPLICATION->AddChainItem('Доставка', '/customer/delivery/');
?>

<section class="map">
    <div class="_container">
        <h2 class="title-page map__title">Доставка</h2>
    </div>
    <div class="chips">
        <div class="_container">
            <div class="chips__inner">
                <button class="chips__item" href="">Казпочта</button>
                <button class="chips__item" href="">СДЭК</button>
                <button class="chips__item" href="">Boxberry</button>
                <button class="chips__item" href="">Склад самовывоза</button>
            </div>
        </div>
    </div>
    <div class="_container">
        <div class="map-content" id="map-delivery"></div>
    </div>
</section>

<?php $APPLICATION->IncludeComponent(
    'coderoom:customer.questions.pay',
    '.default',
    []
); ?>

<?php $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
