<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>

<div class="bx-system-auth-form" style="display: none">

<?
if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE']))
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?=GetMessage("AUTH_LOGIN")?>:<br />
			<input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" />
			<script>
				BX.ready(function() {
					var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
					if (loginCookie)
					{
						var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
						var loginInput = form.elements["USER_LOGIN"];
						loginInput.value = loginCookie;
					}
				});
			</script>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<?=GetMessage("AUTH_PASSWORD")?>:<br />
			<input type="password" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
</script>
<?endif?>
			</td>
		</tr>
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label></td>
		</tr>
<?endif?>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br /></td>
		</tr>
<?endif?>

		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex></td>
		</tr>
<?if($arResult["AUTH_SERVICES"]):?>
		<tr>
			<td colspan="2">
				<div class="bx-auth-lbl"><?=GetMessage("socserv_as_user_form")?></div>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"SUFFIX"=>"form",
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
			</td>
		</tr>
<?endif?>
	</table>
</form>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>

<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
<?if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>
	</table>
</form>

<?
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
		<tr>
			<td align="center">
				<?=$arResult["USER_NAME"]?><br />
				[<?=$arResult["USER_LOGIN"]?>]<br />
				<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td align="center">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
			</td>
		</tr>
	</table>
</form>
<?endif?>
</div>






<form class="modal modal__call">
    <button class="close-window close-window--modal" data-close="modal">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                  fill="#131313"/>
        </svg>
    </button>
    <h2 class="section-title">Войти</h2>
    <ul class="modal__wrap">
        <li class="modal__item">
            <label class="label" for="">Электронная почта</label>
            <input name="email" class="input" type="email" placeholder="mail@domain.ru">
        </li>
        <li class="modal__item">
            <label class="label" for="">Пароль</label>
            <input name="phone" class="input" value="" type="password" placeholder="********">
        </li>
    </ul>
    <a class="modal__link" href="#">Забыли пароль?</a>
    <div class="social__block">
        <span>Или через:</span>
        <a href="#" class="social__wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20.503 7.72211C20.643 8.11147 20.1867 9.00579 19.1342 10.4051C18.9882 10.5997 18.7905 10.8583 18.541 11.1807C18.2977 11.491 18.1304 11.71 18.0391 11.8378C17.9479 11.9655 17.8551 12.1161 17.7608 12.2895C17.6665 12.4629 17.63 12.5907 17.6513 12.6728C17.6726 12.7549 17.7121 12.8599 17.7699 12.9876C17.8277 13.1154 17.9266 13.2462 18.0665 13.38C18.2064 13.5139 18.3798 13.6751 18.5866 13.8637C18.611 13.8759 18.6262 13.888 18.6323 13.9002C19.4901 14.6972 20.0711 15.3694 20.3753 15.917C20.3935 15.9474 20.4133 15.9854 20.4346 16.031C20.4559 16.0767 20.4772 16.1573 20.4985 16.2729C20.5198 16.3885 20.5182 16.4919 20.4939 16.5831C20.4696 16.6744 20.3935 16.758 20.2658 16.8341C20.138 16.9101 19.9585 16.9482 19.7274 16.9482L17.3912 16.9847C17.2452 17.0151 17.0748 16.9999 16.8801 16.939C16.6855 16.8782 16.5273 16.8113 16.4056 16.7383L16.2231 16.6288C16.0406 16.501 15.8277 16.3063 15.5843 16.0447C15.341 15.7831 15.1326 15.5474 14.9592 15.3375C14.7858 15.1276 14.6003 14.9512 14.4025 14.8082C14.2048 14.6652 14.0329 14.6181 13.8869 14.6667C13.8687 14.6728 13.8443 14.6835 13.8139 14.6987C13.7835 14.7139 13.7318 14.758 13.6588 14.831C13.5858 14.904 13.5204 14.9938 13.4626 15.1002C13.4048 15.2067 13.3531 15.3649 13.3074 15.5748C13.2618 15.7846 13.242 16.0204 13.2481 16.282C13.2481 16.3732 13.2375 16.4569 13.2162 16.5329C13.1949 16.609 13.1721 16.6653 13.1477 16.7018L13.1112 16.7474C13.0017 16.863 12.8405 16.9299 12.6276 16.9482H11.5781C11.1462 16.9725 10.7021 16.9223 10.2458 16.7976C9.7895 16.6729 9.38949 16.5117 9.04576 16.3139C8.70202 16.1162 8.38871 15.9154 8.10581 15.7116C7.82292 15.5078 7.60846 15.3329 7.46245 15.1869L7.23431 14.9679C7.17347 14.9071 7.08982 14.8158 6.98336 14.6941C6.87689 14.5724 6.65939 14.2956 6.33087 13.8637C6.00235 13.4317 5.67991 12.9724 5.36355 12.4857C5.04719 11.999 4.67456 11.3572 4.24565 10.5602C3.81675 9.76322 3.41978 8.93582 3.05475 8.07801C3.01825 7.98067 3 7.89854 3 7.83162C3 7.7647 3.00913 7.71603 3.02738 7.68561L3.06388 7.63085C3.15514 7.51526 3.32852 7.45747 3.58404 7.45747L6.08448 7.43921C6.15748 7.45138 6.22745 7.47115 6.29437 7.49853C6.36129 7.52591 6.40996 7.55176 6.44038 7.5761L6.48601 7.60348C6.58335 7.6704 6.65635 7.76774 6.70502 7.8955C6.8267 8.19969 6.96663 8.51452 7.1248 8.84C7.28298 9.16549 7.4077 9.4134 7.49896 9.58375L7.64497 9.84839C7.8214 10.2134 7.99174 10.5298 8.156 10.7975C8.32027 11.0651 8.4678 11.2735 8.5986 11.4226C8.7294 11.5716 8.85564 11.6887 8.97732 11.7739C9.09899 11.8591 9.20242 11.9017 9.28759 11.9017C9.37276 11.9017 9.45489 11.8865 9.53398 11.856C9.54615 11.85 9.56136 11.8347 9.57961 11.8104C9.59786 11.7861 9.63436 11.7192 9.68912 11.6096C9.74387 11.5001 9.78494 11.3572 9.81231 11.1807C9.83969 11.0043 9.86859 10.7579 9.89901 10.4416C9.92943 10.1252 9.92943 9.74497 9.89901 9.30085C9.88684 9.0575 9.85946 8.83544 9.81688 8.63468C9.77429 8.43391 9.7317 8.29399 9.68912 8.2149L9.63436 8.10539C9.48227 7.89854 9.22371 7.76774 8.85868 7.71298C8.77959 7.70082 8.7948 7.62781 8.90431 7.49397C9.00165 7.37838 9.11724 7.28712 9.25109 7.2202C9.57353 7.06202 10.3005 6.98901 11.4321 7.00118C11.931 7.00727 12.3416 7.04681 12.6641 7.11982C12.7858 7.15023 12.8877 7.1913 12.9698 7.24301C13.0519 7.29472 13.1143 7.36773 13.1569 7.46203C13.1995 7.55633 13.2314 7.65367 13.2527 7.75405C13.274 7.85443 13.2846 7.99284 13.2846 8.16927C13.2846 8.3457 13.2816 8.513 13.2755 8.67118C13.2694 8.82936 13.2618 9.04381 13.2527 9.31454C13.2436 9.58527 13.239 9.83622 13.239 10.0674C13.239 10.1343 13.236 10.2621 13.2299 10.4507C13.2238 10.6393 13.2223 10.7853 13.2253 10.8887C13.2284 10.9921 13.239 11.1153 13.2573 11.2583C13.2755 11.4013 13.3105 11.5199 13.3622 11.6142C13.4139 11.7085 13.4824 11.783 13.5675 11.8378C13.6162 11.85 13.6679 11.8621 13.7227 11.8743C13.7774 11.8865 13.8565 11.853 13.9599 11.7739C14.0634 11.6948 14.1789 11.5899 14.3067 11.4591C14.4345 11.3283 14.5926 11.1245 14.7812 10.8477C14.9698 10.5708 15.1767 10.2438 15.4018 9.86664C15.7668 9.23393 16.0923 8.5495 16.3782 7.81337C16.4026 7.75253 16.433 7.6993 16.4695 7.65367C16.506 7.60804 16.5395 7.5761 16.5699 7.55785L16.6064 7.53047L16.652 7.50766L16.7706 7.48028L16.9532 7.47572L19.5813 7.45747C19.8186 7.42705 20.0133 7.43465 20.1654 7.48028C20.3175 7.52591 20.4118 7.5761 20.4483 7.63085L20.503 7.72211Z" fill="#131313"/>
            </svg>
        </a>

        <a href="#" class="social__wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C7.0284 3 3 7.0293 3 12C3 16.9707 7.0284 21 12 21C16.9698 21 21 16.9707 21 12C21 7.0293 16.9698 3 12 3ZM12.3204 8.09934H13.152V17.3351H15.0132V6.65394H12.3105C9.58799 6.65394 8.15249 8.05974 8.15249 10.1189C8.15249 11.7614 8.93549 12.7325 10.3305 13.7324L7.90499 17.345H9.92459L12.6273 13.3067L11.6868 12.6731C10.5483 11.9 9.99389 11.297 9.99389 10.01C9.99389 8.87154 10.7958 8.09934 12.3204 8.09934Z" fill="#131313"/>
            </svg>
        </a>

        <a href="#" class="social__wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M15.7778 7.43382H13.556C13.2934 7.43382 13 7.77931 13 8.24147V9.84587H15.7778V12.1325H13V19H10.3777V12.1328H8V9.84618H10.3777V8.5C10.3777 6.57002 11.7172 5 13.556 5H15.7778V7.43382Z" fill="#131313"/>
            </svg>
        </a>

        <a href="#" class="social__wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M4.8512 8.408C5.51681 7.08259 6.5379 5.96841 7.80035 5.18998C9.06279 4.41154 10.5169 3.99953 12 4C14.156 4 15.9672 4.7928 17.352 6.084L15.0584 8.3784C14.2288 7.5856 13.1744 7.1816 12 7.1816C9.916 7.1816 8.152 8.5896 7.524 10.48C7.364 10.96 7.2728 11.472 7.2728 12C7.2728 12.528 7.364 13.04 7.524 13.52C8.1528 15.4112 9.916 16.8184 12 16.8184C13.076 16.8184 13.992 16.5344 14.7088 16.0544C15.1243 15.7808 15.4801 15.4258 15.7546 15.0108C16.029 14.5958 16.2165 14.1295 16.3056 13.64H12V10.5456H19.5344C19.6288 11.0688 19.68 11.6144 19.68 12.1816C19.68 14.6184 18.808 16.6696 17.2944 18.0616C15.9712 19.284 14.16 20 12 20C10.9493 20.0004 9.90883 19.7938 8.93804 19.3919C7.96724 18.99 7.08516 18.4007 6.34221 17.6578C5.59926 16.9148 5.01 16.0328 4.60811 15.062C4.20622 14.0912 3.99958 13.0507 4 12C4 10.7088 4.3088 9.488 4.8512 8.408Z" fill="#131313"/>
            </svg>
        </a>

        <a href="#" class="social__wrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20.227 6.65729C19.5931 6.93837 18.9119 7.12834 18.197 7.2138C18.9268 6.7764 19.4871 6.08375 19.751 5.25847C19.0572 5.67016 18.2982 5.96022 17.5067 6.11612C16.862 5.42926 15.9435 5 14.9269 5C12.975 5 11.3925 6.58246 11.3925 8.53422C11.3925 8.81126 11.4238 9.08097 11.484 9.33971C8.54668 9.19228 5.94245 7.78525 4.19923 5.64695C3.89506 6.16894 3.72077 6.77613 3.72077 7.42375C3.72077 8.64996 4.34478 9.73169 5.29307 10.3655C4.73181 10.3479 4.18291 10.1964 3.69217 9.92341C3.69197 9.93822 3.69197 9.95302 3.69197 9.96789C3.69197 11.6803 4.91024 13.1088 6.52702 13.4335C6.00657 13.575 5.46065 13.5957 4.93097 13.494C5.38069 14.8982 6.68596 15.9199 8.23249 15.9485C7.0229 16.8964 5.49892 17.4615 3.84311 17.4615C3.55779 17.4615 3.27651 17.4447 3 17.4121C4.56409 18.4149 6.42184 19 8.41774 19C14.9187 19 18.4736 13.6145 18.4736 8.9441C18.4736 8.79081 18.4702 8.63839 18.4633 8.48684C19.1553 7.98665 19.7525 7.3671 20.227 6.65729Z" fill="#131313"/>
            </svg>
        </a>
    </div>
    <button class="btn btn--red btn--l btn--icn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.1 18.6H18.6V18.1V17C18.6 16.7295 18.4457 16.5182 18.3307 16.3909C18.2013 16.2475 18.0306 16.1118 17.8421 15.986C17.4624 15.7325 16.9426 15.4745 16.3437 15.2435C15.1456 14.7814 13.5591 14.4 12 14.4C10.4409 14.4 8.8544 14.7814 7.65632 15.2435C7.05741 15.4745 6.53759 15.7325 6.15785 15.986C5.96945 16.1118 5.79872 16.2475 5.66925 16.3909C5.55427 16.5182 5.4 16.7295 5.4 17V18.1V18.6H5.9H18.1ZM12.995 5.59791C12.6795 5.46725 12.3414 5.4 12 5.4C11.3104 5.4 10.6491 5.67393 10.1615 6.16152C9.67393 6.64912 9.4 7.31044 9.4 8C9.4 8.68956 9.67393 9.35088 10.1615 9.83848C10.6491 10.3261 11.3104 10.6 12 10.6C12.3414 10.6 12.6795 10.5327 12.995 10.4021C13.3104 10.2714 13.597 10.0799 13.8385 9.83848C14.0799 9.59705 14.2714 9.31042 14.4021 8.99498C14.5327 8.67953 14.6 8.34144 14.6 8C14.6 7.65856 14.5327 7.32047 14.4021 7.00502C14.2714 6.68958 14.0799 6.40295 13.8385 6.16152C13.597 5.92009 13.3104 5.72858 12.995 5.59791ZM8.5 8C8.5 6.06614 10.0661 4.5 12 4.5C13.9339 4.5 15.5 6.06614 15.5 8C15.5 9.93386 13.9339 11.5 12 11.5C10.0661 11.5 8.5 9.93386 8.5 8ZM4.5 17C4.5 16.5186 4.73716 16.06 5.21364 15.6202C5.69352 15.1773 6.38208 14.7882 7.18469 14.4666C8.79071 13.8233 10.7275 13.5 12 13.5C13.2725 13.5 15.2093 13.8233 16.8153 14.4666C17.6179 14.7882 18.3065 15.1773 18.7864 15.6202C19.2628 16.06 19.5 16.5186 19.5 17V19C19.5 19.2761 19.2761 19.5 19 19.5H5C4.72386 19.5 4.5 19.2761 4.5 19V17Z" fill="#fff" stroke="#fff"></path>
        </svg>
        Войти
    </button>
    <a class="modal__link center" href="#">Зарегистрироваться</a>
</form>
