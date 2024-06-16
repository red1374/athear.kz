<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle('Покупка и оплата');
?>

<?php $APPLICATION->IncludeComponent(
    'coderoom:customer.payments',
    '.default',
    []
); ?>
<?php $APPLICATION->IncludeComponent(
    'coderoom:customer.methods',
    '.default',
    []
); ?>
<?php $APPLICATION->IncludeComponent(
    'coderoom:customer.questions.section',
    '.default',
    [
        'SECTION_ID'    => 22,
        'QUESTIONS_URL' => '/customer/questions/',
        'BLOCK_TITLE'   => GetMessage('HDR_QUESTIONS_PAY_TITLE'),
    ]
); ?>
<?php $APPLICATION->IncludeComponent(
    'coderoom:main.offers',
    '.default',
    []
); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
