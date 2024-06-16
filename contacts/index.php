<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Контакты");
?>
 <section class="about">
    <div class="_container">
        <h1 class="title-page"><?php $APPLICATION->ShowTitle(false); ?></h1>
        <div class="about__text">
            <div class="footer__top footer__box">
                <div class="footer__col">
                    <? $APPLICATION->IncludeFile("/include/footer-phone.php", [], ["MODE" => "html"]); ?>
                    <? $APPLICATION->IncludeFile("/include/footer-mail.php", [], ["MODE" => "html"]); ?>
                    <? $APPLICATION->IncludeFile("/include/footer-address.php", [], ["MODE" => "html"]); ?>
                    <div class="footer__social footer-social">
                        <? $APPLICATION->IncludeFile("/include/footer-social.php", [], ["MODE" => "html"]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_container _container--mode">
        <?php $APPLICATION->IncludeComponent(
            'coderoom:about.map',
            '.default',
            []
        ); ?>
    </div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>