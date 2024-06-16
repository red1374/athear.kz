<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Гарантия и возврат");
?>

    <section class="map">
        <div class="_container">
            <h2 class="title-page map__title"><?php $APPLICATION->ShowTitle(false); ?></h2>
        </div>
        <div class="_container">
            <div class="guarantee-text">
                <?php $APPLICATION->IncludeFile("/include/guarantee.php", [], ["MODE" => "html"]); ?>
            </div>
        </div>
    </section>

<?php $APPLICATION->IncludeComponent(
    'coderoom:customer.guarantee.pay',
    '.default',
    []
); ?>

<?php $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>