<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

use Bitrix\Main\Engine\CurrentUser;

/**
 * @global $arResult
 */
?>
<div class="tabs__pane-wrap">
    <form class="profile">
        <div class="profile__block">
            <h2 class="title-block profile__title">Личные данные</h2>
            <ul class="profile__list">
                <li class="profile__item">
                    <label class="label" for="">Фамилия</label>
                    <input name="LAST_NAME" class="input" type="text" placeholder="Фамилия" required value="<?php echo $arResult['USER']['LAST_NAME'] ?>">
                </li>
                <li class="profile__item">
                    <label class="label" for="">Имя</label>
                    <input name="NAME" class="input" type="text" placeholder="Имя" required value="<?php echo $arResult['USER']['NAME'] ?>">
                </li>
                <li class="profile__item">
                    <label class="label" for="">Отчество (если есть)</label>
                    <input name="SECOND_NAME" class="input" type="text" placeholder="Отчество (если есть)" value="<?php echo $arResult['USER']['SECOND_NAME'] ?>">
                </li>
                <li class="profile__item profile__item--empty"></li>
                <li class="profile__item">
                    <label class="label" for="">Телефон</label>
                    <input name="PERSONAL_PHONE" class="input tel" type="tel" placeholder="+7 (___) ___-__-__" required value="<?php echo $arResult['USER']['PERSONAL_PHONE'] ?>">
                </li>
                <li class="profile__item">
                    <label class="label" for="">Электронная почта</label>
                    <input name="EMAIL" class="input" type="email " placeholder="Электронная почта" required value="<?php echo $arResult['USER']['EMAIL'] ?>">
                </li>
            </ul>
        </div>
        <div class="profile__block">
            <h2 class="title-block profile__title">Изменить пароль</h2>
            <div class="profile__list">
                <li class="profile__item">
                    <label class="label" for="">Старый пароль</label>
                    <input name="OLD_PASSWORD" class="input" type="password" placeholder="••••••••">
                </li>
                <li class="profile__item profile__item--empty"></li>
                <li class="profile__item">
                    <label class="label" for="">Новый пароль</label>
                    <input name="PASSWORD" class="input" type="password" placeholder="••••••••">
                </li>
                <li class="profile__item">
                    <label class="label" for="">Новый пароль (еще раз)</label>
                    <input name="CONFIRM_PASSWORD" class="input" type="password" placeholder="••••••••">
                </li>
            </div>
        </div>
        <div class="profile__block">
            <h2 class="title-block profile__title">Рассылка</h2>
            <div class="check">
                <input class="input-action" type="checkbox" name="UF_MAIL" id="check-info1" <?php if ($arResult['USER']['UF_MAIL'] == 'Y') echo 'checked'; ?>>
                <label class="label" for="check-info1">Получать информационные материалы 1-2 раза в неделю</label>
            </div>
            <button class="btn btn--red btn--l btn--icn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21H7M17 21H17.803C18.921 21 19.48 21 19.907 20.782C20.284 20.59 20.59 20.284 20.782 19.908C21 19.481 21 18.921 21 17.803V9.22C21 8.77 21 8.545 20.952 8.331C20.9094 8.14007 20.839 7.95643 20.743 7.786C20.637 7.596 20.487 7.431 20.193 7.104L17.438 4.042C17.097 3.664 16.924 3.472 16.717 3.334C16.5303 3.21012 16.3241 3.11851 16.107 3.063C15.863 3 15.6 3 15.075 3H6.2C5.08 3 4.52 3 4.092 3.218C3.71565 3.40969 3.40969 3.71565 3.218 4.092C3 4.52 3 5.08 3 6.2V17.8C3 18.92 3 19.48 3.218 19.907C3.41 20.284 3.715 20.59 4.092 20.782C4.519 21 5.079 21 6.197 21H7M17 21V17.197C17 16.079 17 15.519 16.782 15.092C16.5899 14.7156 16.2836 14.4096 15.907 14.218C15.48 14 14.92 14 13.8 14H10.2C9.08 14 8.52 14 8.092 14.218C7.71565 14.4097 7.40969 14.7157 7.218 15.092C7 15.52 7 16.08 7 17.2V21M15 7H9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg><span>Сохранить изменения</span></button>
        </div>
    </form>
</div>