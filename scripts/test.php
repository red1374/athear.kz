<?php

use Coderoom\Main\Cart\ListCart;
use Bitrix\Sale\PaySystem\Manager;
use Bitrix\Iblock\Elements\ElementPickUpTable;
use Bitrix\Iblock\Elements\ElementDerivationTable;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Оформление заказа");

$obCartList = new ListCart;
$arCartItems = $obCartList->getListItems();

$arPaySystems = Manager::getList([
    'order' => [
        'SORT' => 'DESC',
    ],
    'filter' => [
        'ACTIVE' => 'Y',
    ]
])->fetchAll();

$arPickups = ElementPickUpTable::getList([
    'select' => [
        'ID',
        'NAME',
        'ADDRESS_' => 'ADDRESS',
        'TIME_' => 'TIME',
        'PAY_' => 'PAY'
    ],
])->fetchAll();

$arDerivations = ElementDerivationTable::getList([
    'select' => [
        'ID',
        'NAME',
        'ADDRESS_' => 'ADDRESS',
        'TIME_' => 'TIME',
        'PAY_' => 'PAY',
        'COORDINATES_' => 'COORDINATES'
    ],
])->fetchAll();
?>
<?php if (!empty($arCartItems)) { ?>
    <section class="basket order">
        <div class="_container">
            <a class="order__back" href="/personal/cart/">Вернуться в корзину</a>
            <h1 class="title-page">Оформление заказа</h1>
            <div class="__inner">
                <div class="order__content">
                    <div class="order__block">
                        <div class="title-block profile__title order__title">1. Состав заказа</div>

                        <div class="order__table table">
                            <div class="table__row table__header">
                                <div class="table__item">Товар</div>
                                <div class="table__item">Цена</div>
                                <div class="table__item">Кол-во</div>
                                <div class="table__item">Сумма</div>
                            </div>
                            <?php foreach ($arCartItems as $arItem) { ?>
                                <div class="table__row">
                                    <div class="table__item">
										<span>Товар</span><?php echo $arItem['NAME']; ?>
									</div>
                                    <div class="table__item">
                                        <span>Цена</span><?php echo number_format($arItem['PRICE'], 0, '', ' '); ?> ₸
                                    </div>
                                    <div class="table__item">
                                        <span>Кол-во</span><?php echo number_format($arItem['QUANTITY'], 0); ?></div>
                                    <div class="table__item">
                                        <span>Сумма</span><?php echo number_format($arItem['GENERAL_PRICE'], 0, '', ' '); ?>
                                        ₸
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="order__block">
                        <div class="title-block profile__title order__title">2. Получатель</div>

                        <ul class="profile__list">
                            <li class="profile__item">
                                <label class="label" for="">Фамилия</label>
                                <input name="LAST_NAME" class="input" type="text" placeholder="Фамилия" required
                                       value="">
                            </li>
                            <li class="profile__item">
                                <label class="label" for="">Имя</label>
                                <input name="NAME" class="input" type="text" placeholder="Имя" required value="">
                            </li>
                            <li class="profile__item">
                                <label class="label" for="">Отчество (если есть)</label>
                                <input name="SECOND_NAME" class="input" type="text" placeholder="Отчество (если есть)"
                                       value="">
                            </li>
                            <li class="profile__item profile__item--empty"></li>
                            <li class="profile__item">
                                <label class="label" for="">Телефон</label>
                                <input name="PERSONAL_PHONE" class="input tel" type="tel"
                                       placeholder="+7 (___) ___-__-__" required value="">
                            </li>
                            <li class="profile__item">
                                <label class="label" for="">Электронная почта</label>
                                <input name="PERSONAL_EMAIL" class="input" type="email " placeholder="Электронная почта"
                                       required
                                       value="">
                                <span class="input__error">Введите корректный адрес</span>
                            </li>
                        </ul>

                        <div class="modal__check order__check first__check">
                            <input class="input-action" type="checkbox" name="agree" id="order-privacy" required="">
                            <label for="order-privacy">Даю согласие на обработку </label><a href="">персональных
                                данных</a>
                        </div>

                        <div class="modal__check order__check">
                            <input class="input-action" type="checkbox" name="agree" id="order-conditions" required="">
                            <label for="order-conditions">Даю согласание с условаиями покупки</label>
                        </div>
                    </div>

                    <div class="order__block">
                        <div class="title-block profile__title order__title">3. Доставка и самовывоз</div>

                        <ul class="profile__list">
                            <?php $APPLICATION->IncludeComponent("bitrix:sale.location.selector.search", "", array(
                                "ID" => "",    // ID местоположения
                                "PROVIDE_LINK_BY" => "id",    // Сохранять связь через
                                "INPUT_NAME" => "CITY",    // Имя поля ввода
                                "COMPONENT_TEMPLATE" => ".default",
                                "CODE" => "",    // Символьный код местоположения
                                "FILTER_BY_SITE" => "N",    // Фильтровать по сайту
                                "SHOW_DEFAULT_LOCATIONS" => "N",    // Отображать местоположения по-умолчанию
                                "CACHE_TYPE" => "A",    // Тип кеширования
                                "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                                "JS_CONTROL_GLOBAL_ID" => "",    // Идентификатор javascript-контрола
                                "JS_CALLBACK" => "",    // Javascript-функция обратного вызова
                                "SUPPRESS_ERRORS" => "N",    // Не показывать ошибки, если они возникли при загрузке компонента
                                "INITIALIZE_BY_GLOBAL_EVENT" => "",    // Инициализировать компонент только при наступлении указанного javascript-события на объекте window.document
                            ),
                                false
                            ); ?>
                        </ul>

                        <div class="delivery__wrap">

                        </div>

                        <div class="order__popover pickup hidden">
                            <?php foreach ($arPickups as $arPickup) { ?>
                                <div class="popover">
                                    <div class="popover-inner">
                                        <div class="popover-content">
                                            <ul>
                                                <li>
                                                    <span>Адрес</span><span><?php echo $arPickup['ADDRESS_VALUE']; ?></span>
                                                </li>
                                                <li>
                                                    <span>Время работы</span><span><?php echo $arPickup['TIME_VALUE']; ?></span>
                                                </li>
                                                <li>
                                                    <span>Оплата</span><span><?php echo $arPickup['PAY_VALUE']; ?></span>
                                                </li>
                                                <li class="popover__order">
                                                    <span>Доставка</span><span>24 сентября, 400 ₽</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="map hidden">
                            <div class="map-content map-content--about" id="map-about"></div>
                        </div>

                        <div class="order__title-delivery courier hidden">Адрес доставки</div>

                        <div class="profile__item order__street courier hidden">
                            <label class="label" for="">Улица</label>
                            <input name="STREET" class="input" type="text" placeholder="Улица" required value="">
                        </div>

                        <ul class="profile__list courier hidden">
                            <li class="profile__item">
                                <label class="label" for="">Дом/корпус</label>
                                <input name="HOUSE" class="input" type="text" placeholder="Дом/корпус" required
                                       value="">
                            </li>
                            <li class="profile__item">
                                <label class="label" for="">Квартира/офис</label>
                                <input name="FLAT" class="input" type="text" placeholder="Квартира/офис" value="">
                            </li>

                            <li class="modal__item modal__item--half profile__item">
                                <label class="label">Желаемая дата доставки</label>
                                <div class="modal__item--dp">
                                    <input name="date" class="airPicker input" id="airpicker4" placeholder="дд.мм.гг"
                                           autocomplete="off">
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="order__block">
                        <div class="title-block profile__title order__title">4. Оплата</div>

                        <div class="order__methods">
                            <?php foreach ($arPaySystems as $arSystem) { ?>
                                <label for="pay_<?php echo $arSystem['ID']; ?>" class="order__method method">
                                    <input type="radio" name="PAY" class="radio"
                                           value="<?php echo $arSystem['PSA_NAME']; ?>"
                                           id="pay_<?php echo $arSystem['ID']; ?>">
                                    <span class="method__name"><?php echo $arSystem['PSA_NAME']; ?></span>
                                    <span class="method__radio"></span>
                                </label>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="order__block">
                        <textarea name="MESSAGE" class="input order__message"
                                  placeholder="Комметарий к заказу"></textarea>
                    </div>
                </div>

                <div class="aside-box">
                    <h2 class="section-title">Ваш заказ</h2>
                    <ul class="aside-box__list">
                        <li class="aside-box__item"><span class="aside-box__text">Сумма товаров</span><span
                                    class="aside-box__text"><?php echo $obCartList->getGeneralPrice(); ?> ₸</span></li>
                        <li class="aside-box__item"><span class="aside-box__text">Доставка</span><span
                                    class="aside-box__text">0 ₸</span></li>

                        <li class="aside-box__item"><span class="aside-box__text strong">Итого</span><span
                                    class="aside-box__text strong total-price"><?php echo $obCartList->getGeneralPrice(); ?> ₸</span>
                        </li>
                    </ul>
                    <button class="btn btn--red btn--icn btn--l order-btn">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 9V8C17.5 5.2385 15.2615 3 12.5 3C9.7385 3 7.5 5.2385 7.5 8V9H4.5C3.94772 9 3.5 9.44772 3.5 10V18C3.5 19.6575 4.8425 21 6.5 21H18.5C20.1575 21 21.5 19.6575 21.5 18V10C21.5 9.44772 21.0523 9 20.5 9H17.5ZM9.5 8C9.5 6.34325 10.8433 5 12.5 5C14.1567 5 15.5 6.34325 15.5 8V9H9.5V8ZM19.5 18C19.5 18.5525 19.0525 19 18.5 19H6.5C5.9475 19 5.5 18.5525 5.5 18V11H19.5V18Z"
                                  fill="white"/>
                        </svg>
                        Оформить заказ
                    </button>
                    <p class="order__red">Проверьте правильность заполнения всех полей.</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        try {
            window.addEventListener('DOMContentLoaded', () => {
                ymaps.ready(function () {
                    // Создание экземпляра карты и его привязка к созданному контейнеру.
                    var myMap = new ymaps.Map('map-about', {
                            center: [43.261026, 76.945600],
                            zoom: 13,
                            behaviors: ['default', 'scrollZoom'],
                            controls: [],
                        }),

                        // Создание макета балуна на основе Twitter Bootstrap.
                        MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
                            '<div class="popover top">' +
                            '<a class="close" href="#"><img src="/local/templates/audiotech/images/icns/md-x.svg"></a>' +
                            '<div class="arrow"></div>' +
                            '<div class="popover-inner">' +
                            '$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]' +
                            '</div>' +
                            '</div>', {
                                /**
                                 * Строит экземпляр макета на основе шаблона и добавляет его в родительский HTML-элемент.
                                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#build
                                 * @function
                                 * @name build
                                 */
                                build: function () {
                                    this.constructor.superclass.build.call(this);

                                    this._$element = $('.popover', this.getParentElement());

                                    this.applyElementOffset();

                                    this._$element.find('.close')
                                        .on('click', $.proxy(this.onCloseClick, this));
                                },

                                /**
                                 * Удаляет содержимое макета из DOM.
                                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#clear
                                 * @function
                                 * @name clear
                                 */
                                clear: function () {
                                    this._$element.find('.close')
                                        .off('click');

                                    this.constructor.superclass.clear.call(this);
                                },

                                /**
                                 * Метод будет вызван системой шаблонов АПИ при изменении размеров вложенного макета.
                                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
                                 * @function
                                 * @name onSublayoutSizeChange
                                 */
                                onSublayoutSizeChange: function () {
                                    MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

                                    if (!this._isElement(this._$element)) {
                                        return;
                                    }

                                    this.applyElementOffset();

                                    this.events.fire('shapechange');
                                },

                                /**
                                 * Сдвигаем балун, чтобы "хвостик" указывал на точку привязки.
                                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
                                 * @function
                                 * @name applyElementOffset
                                 */
                                applyElementOffset: function () {
                                    this._$element.css({
                                        left: -(this._$element[0].offsetWidth / 2),
                                        top: -(this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight)
                                    });
                                },

                                /**
                                 * Закрывает балун при клике на крестик, кидая событие "userclose" на макете.
                                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
                                 * @function
                                 * @name onCloseClick
                                 */
                                onCloseClick: function (e) {
                                    e.preventDefault();

                                    this.events.fire('userclose');
                                },

                                /**
                                 * Проверяем наличие элемента (в ИЕ и Опере его еще может не быть).
                                 * @function
                                 * @private
                                 * @name _isElement
                                 * @param {jQuery} [element] Элемент.
                                 * @returns {Boolean} Флаг наличия.
                                 */
                                _isElement: function (element) {
                                    return element && element[0] && element.find('.arrow')[0];
                                }
                            }),

                        // Создание вложенного макета содержимого балуна.
                        MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
                            '<h3 class="popover-title">$[properties.balloonHeader]</h3>' +
                            '<div class="popover-content">$[properties.balloonContent]</div>'
                        ),

                        <?php foreach ($arDerivations as $arItem) { ?>
                        myPlacemark<?php echo $arItem['ID']; ?> = window.myPlacemark = new ymaps.Placemark([<?php echo $arItem['COORDINATES_VALUE'] ?>], {
                            balloonHeader: '<?php echo $arItem["NAME"]; ?>',
                            balloonContent: '<ul><li><span>Адрес</span><span><?php echo $arPickup['ADDRESS_VALUE']; ?></span><li><span>Время работы</span><span><?php echo $arPickup['TIME_VALUE']; ?></span></li><li><span>Оплата</span><span><?php echo $arPickup['PAY_VALUE']; ?></span></li><li class="popover__order"><span>Доставка</span><span>24 сентября, 400 ₽</span></li></ul>'
                        }, {
                            balloonShadow: false,
                            balloonLayout: MyBalloonLayout,
                            balloonContentLayout: MyBalloonContentLayout,
                            balloonPanelMaxMapArea: 0,
                            // Не скрываем иконку при открытом балуне.
                            hideIconOnBalloonOpen: false,
                            // И дополнительно смещаем балун, для открытия над иконкой.
                            // balloonOffset: [3, -40]
                            // Необходимо указать данный тип макета.
                            iconLayout: 'default#image',
                            // Своё изображение иконки метки.
                            iconImageHref: '/local/templates/audiotech/images/icns/sm-location-marker.svg',
                            // Размеры метки.
                            iconImageSize: [32, 32],
                            // Смещение левого верхнего угла иконки относительно
                            // её "ножки" (точки привязки).
                            hideIconOnBalloonOpen: false,
                            iconImageOffset: [-5, -38]
                        });
                    <?php } ?>

                    <?php foreach ($arDerivations as $arItem) { ?>
                    myMap.geoObjects.add(myPlacemark<?php echo $arItem['ID']; ?>);
                    <?php } ?>
                });
            });
        } catch (e) {
            console.log(e);
        }
    </script>
<?php } else { ?>
    <section class="basket order">
        <div class="_container">
            <a class="order__back" href="/personal/cart/">Вернуться в корзину</a>
            <h1 class="title-page">Оформление заказа</h1>
            <div class="__inner">
                <div class="order__content">
                    <div class="order__block">Чтобы оформить заказ сначала нужно добавить товары в корзину.</div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>