<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Вопрос-ответ');
?>

<section class="questions">
    <div class="_container">
        <h1 class="title-page"><? $APPLICATION->ShowTitle(false); ?></h1>
    </div>
    <? $APPLICATION->IncludeComponent(
        'coderoom:customer.questions',
        '.default',
        []
    ); ?>
</section>

<? $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
