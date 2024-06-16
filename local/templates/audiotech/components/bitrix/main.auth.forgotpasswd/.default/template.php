<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

\Bitrix\Main\Page\Asset::getInstance()->addCss(
	'/bitrix/css/main/system.auth/flat/style.css'
);

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_PWD_SUCCESS');
	return;
}
?>

<form class="modal modal__call forgot-form"  name="bform" method="post" target="_top" action="<?=POST_FORM_ACTION_URI?>">
    <?php if ($arResult['SUCCESS']) { ?>
        <div class="alert alert-success">
            <?= $arResult['SUCCESS'];?>
        </div>
    <?php } ?>
    <div class="close-window close-window--modal" data-close="modal">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                  fill="#131313"/>
        </svg>
    </div>
    <h2 class="section-title">Восстановление пароля</h2>
    <ul class="modal__wrap">
        <input type="hidden" name="<?php echo $arResult['FIELDS']['login'];?>"  value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" />
        <li class="modal__item">
            <label class="label" for="">Электронная почта</label>
            <input name="<?php echo $arResult['FIELDS']['email'];?>" class="input" type="email" placeholder="mail@domain.ru" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" required>
        </li>
    </ul>
    <div class="modal__link text">Введите адрес электронной почты, который вы указывали при регистрации. Мы пришлем на него дальнейшие инструкции.</div>
    <div class="btn-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
            <path d="M15.5 7.00001C16.0304 7.00001 16.5391 7.21073 16.9142 7.5858C17.2893 7.96087 17.5 8.46958 17.5 9.00001M21.5 9.00001C21.5003 9.93719 21.281 10.8614 20.8598 11.6986C20.4386 12.5357 19.8271 13.2626 19.0744 13.8209C18.3216 14.3792 17.4486 14.7534 16.5252 14.9135C15.6018 15.0737 14.6538 15.0153 13.757 14.743L11.5 17H9.5V19H7.5V21H4.5C4.23478 21 3.98043 20.8947 3.79289 20.7071C3.60536 20.5196 3.5 20.2652 3.5 20V17.414C3.50006 17.1488 3.60545 16.8945 3.793 16.707L9.757 10.743C9.50745 9.91803 9.43857 9.04896 9.55504 8.19496C9.67152 7.34096 9.97062 6.52208 10.432 5.79406C10.8934 5.06604 11.5062 4.44596 12.2287 3.97603C12.9512 3.50611 13.7665 3.19736 14.6191 3.07082C15.4716 2.94427 16.3415 3.0029 17.1693 3.2427C17.9972 3.4825 18.7637 3.89785 19.4166 4.46048C20.0696 5.02311 20.5936 5.71981 20.9531 6.50315C21.3127 7.2865 21.4992 8.13811 21.5 9.00001Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <input type="submit" name="<?php echo $arResult['FIELDS']['action'];?>" value="Восстановить пароль" class="btn btn--red btn--l btn--icn">
    </div>
    <?php
    if (!empty($arResult["ERRORS"])) {
        foreach ($arResult["ERRORS"] as $key => $error) {
            if (intval($key) == 0 && $key !== 0) {
                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
            }
        }
        ShowError(implode("<br />", $arResult["ERRORS"]));
    }
    ?>
    <a class="modal__link center entry" href="#modalEntry">Войти</a>
</form>

<script type="text/javascript">
    document.bform.onsubmit = function(){document.bform.<?= $arResult['FIELDS']['email'];?>.value = document.bform.<?= $arResult['FIELDS']['login'];?>.value;};
    document.bform.<?= $arResult['FIELDS']['login'];?>.focus();
</script>