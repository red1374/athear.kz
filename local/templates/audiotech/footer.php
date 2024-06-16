</main>
<footer class="footer">
    <div class="_container">
        <div class="footer__top footer__box">
            <div class="footer__col">
                <? $APPLICATION->IncludeFile("/include/footer-phone.php", [], ["MODE" => "html"]); ?>
                <? $APPLICATION->IncludeFile("/include/footer-mail.php", [], ["MODE" => "html"]); ?>
                <? $APPLICATION->IncludeFile("/include/footer-address.php", [], ["MODE" => "html"]); ?>
                <div class="footer__social footer-social">
                    <? $APPLICATION->IncludeFile("/include/footer-social.php", [], ["MODE" => "html"]); ?>
                </div>
            </div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                [
                    "ROOT_MENU_TYPE" => "bottom",
                ],
                false
            );?>
            <div class="footer__col"><a class="footer__title">Подпишитесь на рассылку</a>
                <div class="footer-form__subtext">Узнайте первыми про наши продукты и получайте полезные советы о слухе</div>
                <div class="footer__col-form footer-form form_container" data-name="subscribe"></div>
                <div class="footer__text"><?=GetMessage('HDR_AGREEMENT_LINK')?></div>
            </div>
        </div>
        <div class="footer__bottom footer__box">
            <div class="footer__col footer__copy">
                <? $APPLICATION->IncludeFile("/include/footer-rights.php", [], ["MODE" => "html"]); ?>
            </div>
            <div class="footer__col">
                <a href="/private-policy/"><?=GetMessage('HDR_AGREEMENT_TEXT')?></a>
            </div>
            <? $APPLICATION->IncludeFile("/include/footer-design.php", [], ["MODE" => "html"]); ?>
        </div>
    </div>
</footer>

<div id="overlay"></div>
<div class="modal-wrap" id="modalReg">
    <div class="modal modal__reg">
        <script data-b24-form="inline/7/sdk2t8" data-skip-moving="true">(function(w,d,u){var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})(window,document,'https://cdn-ru.bitrix24.ru/b26761420/crm/form/loader_7.js');</script>
        <?/*<script data-b24-form="click/7/sdk2t8" data-skip-moving="true">(function(w,d,u){var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})(window,document,'https://cdn-ru.bitrix24.ru/b26761420/crm/form/loader_7.js');</script>*/?>
    </div>
    <?/*<form class="modal modal__reg formValidate form">
        <input type="hidden" name="formName" value="Запись на приём">
        <button class="close-window close-window--modal" data-close="modal">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                      fill="#131313"/>
            </svg>
        </button>
        <h2 class="section-title">Запись на приём</h2>
        <ul class="modal__wrap">
            <li class="modal__item">
                <label class="label" for="inputName">Ваше имя</label>
                <input name="name" class="input" type="text" id="inputName" placeholder="Николаев Дмитрий Александрович"
                       required>
            </li>
            <li class="modal__item modal__item--half">
                <label class="label" for="inputPhone">Телефон</label>
                <input name="phone" class="tel input" type="tel" id="inputPhone" value=""
                       placeholder="+7 (___) ___-__-__" required>
            </li>
            <li class="modal__item modal__item--half">
                <label class="label" for="">Электронная почта</label>
                <input name="email" class="input" type="email" id="inputEmail" placeholder="mail@domain.ru" required>
            </li>
            <li class="modal__item" id="inputDoc">
                <label class="label" for="nameDoctor">Имя специалиста</label>
                <input name="doctor" type="text" class="input" id="nameDoctor" disabled>
            </li>
            <li class="modal__item">
                <label class="label" for="center">Центр слуха</label>
                <select name="center" id="center" class="mySelect" required>
                    <option value="default" selected>Выберите центр слуха</option>
                    <?php
                    $arCenters = \Bitrix\Iblock\Elements\ElementCentersTable::getList([
                        'select' => ['ID', 'NAME']
                    ])->fetchAll();

                    foreach ($arCenters as $arCenter) { ?>
                        <option value="<?=$arCenter['NAME']; ?><"><?=$arCenter['NAME']; ?></option>
                    <? } ?>
                </select>
            </li>
            <li class="modal__item modal__item--half">
                <label class="label" for="reception">Приём</label>
                <select name="reception" id="reception" class="mySelect mySelectPriem" required>
                    <option value="default" selected>Выберите прием</option>
                    <?php
                    $arReceptions = \Bitrix\Iblock\Elements\ElementPriemTable::getList([
                        'select' => ['ID', 'NAME']
                    ])->fetchAll();

                    foreach ($arReceptions as $arReception) { ?>
                        <option value="<?=$arReception['NAME']; ?><"><?=$arReception['NAME']; ?></option>
                    <? } ?>
                </select>
            </li>
            <li class="modal__item modal__item--half">
                <label class="label">Дата записи</label>
                <div class="modal__item--dp">
                    <input name="date" class="airPicker input" id="airpicker" placeholder="дд.мм.гг" autocomplete="off"
                           disabled>
                </div>
            </li>
            <li class="modal__item modal__times-wrap hidden">
                <label class="label">Доступное время</label>
                <div class="modal__times hidden">
                    <div class="modal__time">
                        <input class="input-action" type="radio" id="time1" name="time" value="11:00" required>
                        <label for="time1">11:00 </label>
                    </div>
                    <div class="modal__time">
                        <input class="input-action" type="radio" id="time2" name="time" value="12:00" required>
                        <label for="time2">12:00 </label>
                    </div>
                    <div class="modal__time">
                        <input class="input-action" type="radio" id="time3" name="time" value="14:00" required>
                        <label for="time3">14:00 </label>
                    </div>
                    <div class="modal__time">
                        <input class="input-action" type="radio" id="time4" name="time" value="15:00" required>
                        <label for="time4">15:00 </label>
                    </div>
                    <div class="modal__time">
                        <input class="input-action" type="radio" id="time5" name="time" value="16:00" required>
                        <label for="time5">16:00 </label>
                    </div>
                    <div class="modal__time">
                        <input class="input-action" type="radio" id="time6" name="time" value="17:00" required>
                        <label for="time6">17:00 </label>
                    </div>
                </div>
            </li>
            <li class="modal__item">
                <label class="label" for="message">Комментарий к записи</label>
                <textarea class="textarea" name="message" id="message" placeholder="Сообщение"></textarea>
            </li>
        </ul>
        <div class="modal__check">
            <input class="input-action" type="checkbox" name="agree" id="agr1" required checked>
            <label for="agr1">Даю согласие на обработку </label><a href="">персональных данных</a>
        </div>
        <button class="btn btn--red btn--l btn--icn" type="submit">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M8 2C8.55228 2 9 2.44772 9 3V4H15V3C15 2.44772 15.4477 2 16 2C16.5523 2 17 2.44772 17 3V4H19C19.7957 4 20.5587 4.31607 21.1213 4.87868C21.6839 5.44129 22 6.20435 22 7V19C22 19.7957 21.6839 20.5587 21.1213 21.1213C20.5587 21.6839 19.7957 22 19 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7957 2 19V7C2 6.20435 2.31607 5.44129 2.87868 4.87868C3.44129 4.31607 4.20435 4 5 4H7V3C7 2.44772 7.44772 2 8 2ZM7 6H5C4.73478 6 4.48043 6.10536 4.29289 6.29289C4.10536 6.48043 4 6.73478 4 7V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H19C19.2652 20 19.5196 19.8946 19.7071 19.7071C19.8946 19.5196 20 19.2652 20 19V7C20 6.73478 19.8946 6.48043 19.7071 6.29289C19.5196 6.10536 19.2652 6 19 6H17V7C17 7.55228 16.5523 8 16 8C15.4477 8 15 7.55228 15 7V6H9V7C9 7.55228 8.55228 8 8 8C7.44772 8 7 7.55228 7 7V6Z"
                      fill="white"/>
                <path d="M9 11C9 11.5523 8.55228 12 8 12C7.44772 12 7 11.5523 7 11C7 10.4477 7.44772 10 8 10C8.55228 10 9 10.4477 9 11Z"
                      fill="white"/>
                <path d="M9 15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15C7 14.4477 7.44772 14 8 14C8.55228 14 9 14.4477 9 15Z"
                      fill="white"/>
                <path d="M13 11C13 11.5523 12.5523 12 12 12C11.4477 12 11 11.5523 11 11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11Z"
                      fill="white"/>
                <path d="M13 15C13 15.5523 12.5523 16 12 16C11.4477 16 11 15.5523 11 15C11 14.4477 11.4477 14 12 14C12.5523 14 13 14.4477 13 15Z"
                      fill="white"/>
                <path d="M17 11C17 11.5523 16.5523 12 16 12C15.4477 12 15 11.5523 15 11C15 10.4477 15.4477 10 16 10C16.5523 10 17 10.4477 17 11Z"
                      fill="white"/>
            </svg>
            Отправить заявку
        </button>
    </form>*/?>
</div>

<?/*<div class="modal-wrap" id="modalCall">
    <form class="modal modal__call form">
        <input type="hidden" name="formName" value="Заказать звонок">
        <button class="close-window close-window--modal" data-close="modal">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                      fill="#131313"/>
            </svg>
        </button>
        <h2 class="section-title">Заказать звонок</h2>
        <ul class="modal__wrap">
            <li class="modal__item">
                <label class="label" for="">Ваше имя</label>
                <input name="name" class="input" type="text" placeholder="Николаев Дмитрий Александрович">
            </li>
            <li class="modal__item">
                <label class="label" for="">Телефон</label>
                <input name="phone" class="tel input" value="" placeholder="+7 (___) ___-__-__">
            </li>
        </ul>
        <div class="modal__check">
            <input name="agree" class="input-action" type="checkbox" id="agr2" required checked>
            <label for="agr2">Даю согласие на обработку </label><a href="">персональных данных</a>
        </div>
        <button class="btn btn--red btn--l btn--icn">
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M5.50078 4.01249C5.23888 4.01249 4.98771 4.11653 4.80251 4.30172C4.61732 4.48691 4.51328 4.73809 4.51328 4.99999V5.99999C4.51328 13.7248 10.776 19.9875 18.5008 19.9875H19.5008C19.7627 19.9875 20.0139 19.8835 20.1991 19.6983C20.3842 19.5131 20.4883 19.2619 20.4883 19V15.7298L16.0147 14.2382L14.8891 16.4863C14.6458 16.9723 14.0622 17.1795 13.5669 16.9557C10.8938 15.7479 8.75286 13.6069 7.54509 10.9339C7.3213 10.4386 7.52849 9.85495 8.0145 9.61162L10.2626 8.4861L8.77101 4.01249H5.50078ZM3.37062 2.86983C3.93558 2.30488 4.70182 1.98749 5.50078 1.98749H8.78155C9.20376 1.98781 9.61518 2.12091 9.95757 2.36795C10.2999 2.61493 10.5559 2.96329 10.6893 3.36374C10.6893 3.36364 10.6893 3.36384 10.6893 3.36374L12.1876 7.85761C12.3403 8.31714 12.3223 8.81634 12.1367 9.26363C11.9512 9.71066 11.6109 10.0759 11.1781 10.2924C11.178 10.2924 11.1781 10.2923 11.1781 10.2924C11.1779 10.2925 11.1775 10.2926 11.1773 10.2927L9.83325 10.9657C10.7176 12.5054 11.9954 13.7832 13.5351 14.6675L14.208 13.3235C14.2079 13.3237 14.2081 13.3233 14.208 13.3235C14.2081 13.3234 14.2084 13.3228 14.2084 13.3227C14.4249 12.8899 14.7901 12.5495 15.2371 12.3641C15.6844 12.1785 16.1836 12.1604 16.6432 12.3132L21.1367 13.8114C21.1366 13.8113 21.1368 13.8114 21.1367 13.8114C21.5375 13.9449 21.8864 14.2013 22.1334 14.544C22.3804 14.8867 22.5133 15.2985 22.5133 15.721C22.5133 15.7209 22.5133 15.7211 22.5133 15.721V19C22.5133 19.799 22.1959 20.5652 21.6309 21.1301C21.066 21.6951 20.2997 22.0125 19.5008 22.0125H18.5008C9.65759 22.0125 2.48828 14.8432 2.48828 5.99999V4.99999C2.48828 4.20102 2.80567 3.43478 3.37062 2.86983Z"
                      fill="white"/>
            </svg>
            Отправить заявку
        </button>
    </form>
</div>*/?>

<div class="modal-wrap" id="modalEntry">
    <?php
    $APPLICATION->IncludeComponent("bitrix:main.auth.form", "auth", Array(
        "REGISTER_URL" => "",
        "FORGOT_PASSWORD_URL" => "",
        "PROFILE_URL" => "/personal/",
        "SHOW_ERRORS" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "AUTH_FORGOT_PASSWORD_URL" => "",	// Страница для восстановления пароля
        "AUTH_REGISTER_URL" => "",	// Страница для регистрации
        "AUTH_SUCCESS_URL" => "/personal/",	// Страница после успешной авторизации
    ),
        false
    );
    ?>
</div>

<? if (!$GLOBALS['USER']->isAuthorized()):?>
<div class="modal-wrap" id="modalForgot">
    <? $APPLICATION->IncludeComponent("bitrix:main.auth.forgotpasswd", ".default", Array(), false); ?>
</div>
<div class="modal-wrap" id="modalRegister">
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.register",
        ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "SHOW_FIELDS" => array(
                0 => "EMAIL",
                1 => "NAME",
                2 => "LAST_NAME",
                3 => "PERSONAL_PHONE",
            ),
            "REQUIRED_FIELDS" => array(
                0 => "EMAIL",
                1 => "NAME",
                2 => "LAST_NAME",
                3 => "PERSONAL_PHONE",
            ),
            "AUTH" => "Y",
            "USE_BACKURL" => "N",
            "SUCCESS_PAGE" => "/personal/",
            "SET_TITLE" => "N",
            "USER_PROPERTY" => array(
            ),
            "USER_PROPERTY_NAME" => ""
        ),
        false
    ); ?>
</div>
<? endif?>
    <div class="modal-wrap" id="modalAccept">
        <div class="modal modal__accept">
            <img class="modal__accept-pic" src="<?=SITE_TEMPLATE_PATH ?>/images/check.svg" alt="">
            <h2 class="section-title">Ваша заявка принята!</h2>
            <p class="modal__text">В ближайшее время наши менеджеры свяжутся с вами для уточнения деталей.</p>
        </div>
    </div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    var dataLaer = [];
setTimeout(function(){
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(97100742, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
}, 700);
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/97100742" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
setTimeout(function(){
    (function(w,d,u){
    var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
    var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://cdn-ru.bitrix24.ru/b26761420/crm/site_button/loader_1_w76ed1.js');

    setTimeout(function(){
        SC.setCallEvent();
    }, 500);
},4000);
</script>

</body>
</html>