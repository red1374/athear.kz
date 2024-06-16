try {
    window.addEventListener('DOMContentLoaded', () => {
        if (typeof(ymaps) == 'undefined'){
            return false;
        }
        ymaps.ready(function () {
            // Создание экземпляра карты и его привязка к созданному контейнеру.
            var myMap = new ymaps.Map('map', {
                    center: [43.261026, 76.945600],
                    zoom: 15,
                    behaviors: ['default', 'scrollZoom'],
                    controls: [],
                }),

                // Создание макета балуна на основе Twitter Bootstrap.
                MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
                    '<div class="popover top">' +
                    '<a class="close" href="#"><img src="/local/templates/audiotech/images/icns/md-x.svg"></a>' +
                    '<div class="arrow"></div>' +
                    '<div class="popover-inner">' +
                    '$[[options.contentLayout observeSize minWidth=220 maxWidth=220 maxHeight=417]]' +
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
                         * Используется для автопозиционирования (balloonAutoPan).
                         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ILayout.xml#getClientBounds
                         * @function
                         * @name getClientBounds
                         * @returns {Number[][]} Координаты левого верхнего и правого нижнего углов шаблона относительно точки привязки.
                         */
                        // getShape: function () {
                        //     if(!this._isElement(this._$element)) {
                        //         return MyBalloonLayout.superclass.getShape.call(this);
                        //     }

                        //     var position = this._$element.position();

                        //     return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                        //         [position.left, position.top], [
                        //             position.left + this._$element[0].offsetWidth,
                        //             position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
                        //         ]
                        //     ]));
                        // },

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

                // Создание метки с пользовательским макетом балуна.
                myPlacemark = window.myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                    //balloonHeader: 'Центр слуха на пр-т Назарбаева, 77',
                    //balloonContent: '<ul><li><span>Адрес</span><span>Алматы, ул. пр-т Назарбаева, 77</span></li><li><span>Время работы</span><span>Пн-Пт: 10:00-19:00<br>Сб-Вс: 10:00-17:00</span></li><li><span>Телефон</span><span>+7 (727) 312-27-03</span></li><li><span>Электронная почта</span><span>info@athear.kz</span></li><li class="popover__footer"><a class="btn btn--icn btn--red btn--m" href="#" data-target="modal-reg"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C8.55228 2 9 2.44772 9 3V4H15V3C15 2.44772 15.4477 2 16 2C16.5523 2 17 2.44772 17 3V4H19C19.7957 4 20.5587 4.31607 21.1213 4.87868C21.6839 5.44129 22 6.20435 22 7V19C22 19.7957 21.6839 20.5587 21.1213 21.1213C20.5587 21.6839 19.7957 22 19 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7957 2 19V7C2 6.20435 2.31607 5.44129 2.87868 4.87868C3.44129 4.31607 4.20435 4 5 4H7V3C7 2.44772 7.44772 2 8 2ZM7 6H5C4.73478 6 4.48043 6.10536 4.29289 6.29289C4.10536 6.48043 4 6.73478 4 7V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H19C19.2652 20 19.5196 19.8946 19.7071 19.7071C19.8946 19.5196 20 19.2652 20 19V7C20 6.73478 19.8946 6.48043 19.7071 6.29289C19.5196 6.10536 19.2652 6 19 6H17V7C17 7.55228 16.5523 8 16 8C15.4477 8 15 7.55228 15 7V6H9V7C9 7.55228 8.55228 8 8 8C7.44772 8 7 7.55228 7 7V6Z" fill="white"></path><path d="M9 11C9 11.5523 8.55228 12 8 12C7.44772 12 7 11.5523 7 11C7 10.4477 7.44772 10 8 10C8.55228 10 9 10.4477 9 11Z" fill="white"></path><path d="M9 15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15C7 14.4477 7.44772 14 8 14C8.55228 14 9 14.4477 9 15Z" fill="white"></path><path d="M13 11C13 11.5523 12.5523 12 12 12C11.4477 12 11 11.5523 11 11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11Z" fill="white"></path><path d="M13 15C13 15.5523 12.5523 16 12 16C11.4477 16 11 15.5523 11 15C11 14.4477 11.4477 14 12 14C12.5523 14 13 14.4477 13 15Z" fill="white"></path><path d="M17 11C17 11.5523 16.5523 12 16 12C15.4477 12 15 11.5523 15 11C15 10.4477 15.4477 10 16 10C16.5523 10 17 10.4477 17 11Z" fill="white"></path></svg>Записаться на приём</a></li></ul>'
                    balloonContent: '<div class="popover top">' +
                        '<img src="/local/templates/audiotech/images/icns/md-x.svg"></a>' +
                        '<div class="arrow"></div>' +
                        '<div class="popover-inner">' +
                        '<h3 class="popover-title">Центр слуха на пр-т Назарбаева, 77</h3>' +
                        '<div class="popover-content">'+
                        '<ul><li><span>Адрес</span><span>Алматы, ул. пр-т Назарбаева, 77</span></li><li><span>Время работы</span><span>Пн-Пт: 10:00-19:00<br>Сб-Вс: 10:00-17:00</span></li><li><span>Телефон</span><span>+7 (727) 312-27-03</span></li><li><span>Электронная почта</span><span>info@athear.kz</span></li><li class="popover__footer"><a class="btn btn--icn btn--red btn--m" href="#" data-target="modal-reg"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C8.55228 2 9 2.44772 9 3V4H15V3C15 2.44772 15.4477 2 16 2C16.5523 2 17 2.44772 17 3V4H19C19.7957 4 20.5587 4.31607 21.1213 4.87868C21.6839 5.44129 22 6.20435 22 7V19C22 19.7957 21.6839 20.5587 21.1213 21.1213C20.5587 21.6839 19.7957 22 19 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7957 2 19V7C2 6.20435 2.31607 5.44129 2.87868 4.87868C3.44129 4.31607 4.20435 4 5 4H7V3C7 2.44772 7.44772 2 8 2ZM7 6H5C4.73478 6 4.48043 6.10536 4.29289 6.29289C4.10536 6.48043 4 6.73478 4 7V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H19C19.2652 20 19.5196 19.8946 19.7071 19.7071C19.8946 19.5196 20 19.2652 20 19V7C20 6.73478 19.8946 6.48043 19.7071 6.29289C19.5196 6.10536 19.2652 6 19 6H17V7C17 7.55228 16.5523 8 16 8C15.4477 8 15 7.55228 15 7V6H9V7C9 7.55228 8.55228 8 8 8C7.44772 8 7 7.55228 7 7V6Z" fill="white"></path><path d="M9 11C9 11.5523 8.55228 12 8 12C7.44772 12 7 11.5523 7 11C7 10.4477 7.44772 10 8 10C8.55228 10 9 10.4477 9 11Z" fill="white"></path><path d="M9 15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15C7 14.4477 7.44772 14 8 14C8.55228 14 9 14.4477 9 15Z" fill="white"></path><path d="M13 11C13 11.5523 12.5523 12 12 12C11.4477 12 11 11.5523 11 11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11Z" fill="white"></path><path d="M13 15C13 15.5523 12.5523 16 12 16C11.4477 16 11 15.5523 11 15C11 14.4477 11.4477 14 12 14C12.5523 14 13 14.4477 13 15Z" fill="white"></path><path d="M17 11C17 11.5523 16.5523 12 16 12C15.4477 12 15 11.5523 15 11C15 10.4477 15.4477 10 16 10C16.5523 10 17 10.4477 17 11Z" fill="white"></path></svg>Записаться на приём</a></li></ul>' +
                        '</div>'+
                        '</div>' +
                        '</div>'
                }, {
                    balloonShadow: false,
                    //balloonLayout: MyBalloonLayout,
                    //balloonContentLayout: MyBalloonContentLayout,
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

            myMap.geoObjects.add(myPlacemark);
        });
    });
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJiYWxsb29uX2h0bWwtbWFwLmpzIl0sInNvdXJjZXNDb250ZW50IjpbInltYXBzLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgICAvLyDQodC+0LfQtNCw0L3QuNC1INGN0LrQt9C10LzQv9C70Y/RgNCwINC60LDRgNGC0Ysg0Lgg0LXQs9C+INC/0YDQuNCy0Y/Qt9C60LAg0Log0YHQvtC30LTQsNC90L3QvtC80YMg0LrQvtC90YLQtdC50L3QtdGA0YMuXG4gICAgdmFyIG15TWFwID0gbmV3IHltYXBzLk1hcCgnbWFwJywge1xuICAgICAgICAgICAgY2VudGVyOiBbNTUuNzUxNTc0LCAzNy41NzM4NTZdLFxuICAgICAgICAgICAgem9vbTogOSxcbiAgICAgICAgICAgIGJlaGF2aW9yczogWydkZWZhdWx0JywgJ3Njcm9sbFpvb20nXSxcbiAgICAgICAgICAgIGNvbnRyb2xzOiBbXSxcbiAgICAgICAgfSksXG5cbiAgICAgICAgLy8g0KHQvtC30LTQsNC90LjQtSDQvNCw0LrQtdGC0LAg0LHQsNC70YPQvdCwINC90LAg0L7RgdC90L7QstC1IFR3aXR0ZXIgQm9vdHN0cmFwLlxuICAgICAgICBNeUJhbGxvb25MYXlvdXQgPSB5bWFwcy50ZW1wbGF0ZUxheW91dEZhY3RvcnkuY3JlYXRlQ2xhc3MoXG4gICAgICAgICAgICAnPGRpdiBjbGFzcz1cInBvcG92ZXIgdG9wXCI+JyArXG4gICAgICAgICAgICAgICAgJzxhIGNsYXNzPVwiY2xvc2VcIiBocmVmPVwiI1wiPjxpbWcgc3JjPVwiaW1nL2ljbnMvbWQteC5zdmdcIj48L2E+JyArXG4gICAgICAgICAgICAgICAgJzxkaXYgY2xhc3M9XCJhcnJvd1wiPjwvZGl2PicgK1xuICAgICAgICAgICAgICAgICc8ZGl2IGNsYXNzPVwicG9wb3Zlci1pbm5lclwiPicgK1xuICAgICAgICAgICAgICAgICckW1tvcHRpb25zLmNvbnRlbnRMYXlvdXQgb2JzZXJ2ZVNpemUgbWluV2lkdGg9MjIwIG1heFdpZHRoPTIyMCBtYXhIZWlnaHQ9NDE3XV0nICtcbiAgICAgICAgICAgICAgICAnPC9kaXY+JyArXG4gICAgICAgICAgICAgICAgJzwvZGl2PicsIHtcbiAgICAgICAgICAgICAgICAvKipcbiAgICAgICAgICAgICAgICAgKiDQodGC0YDQvtC40YIg0Y3QutC30LXQvNC/0LvRj9GAINC80LDQutC10YLQsCDQvdCwINC+0YHQvdC+0LLQtSDRiNCw0LHQu9C+0L3QsCDQuCDQtNC+0LHQsNCy0LvRj9C10YIg0LXQs9C+INCyINGA0L7QtNC40YLQtdC70YzRgdC60LjQuSBIVE1MLdGN0LvQtdC80LXQvdGCLlxuICAgICAgICAgICAgICAgICAqIEBzZWUgaHR0cHM6Ly9hcGkueWFuZGV4LnJ1L21hcHMvZG9jL2pzYXBpLzIuMS9yZWYvcmVmZXJlbmNlL2xheW91dC50ZW1wbGF0ZUJhc2VkLkJhc2UueG1sI2J1aWxkXG4gICAgICAgICAgICAgICAgICogQGZ1bmN0aW9uXG4gICAgICAgICAgICAgICAgICogQG5hbWUgYnVpbGRcbiAgICAgICAgICAgICAgICAgKi9cbiAgICAgICAgICAgICAgICBidWlsZDogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICB0aGlzLmNvbnN0cnVjdG9yLnN1cGVyY2xhc3MuYnVpbGQuY2FsbCh0aGlzKTtcblxuICAgICAgICAgICAgICAgICAgICB0aGlzLl8kZWxlbWVudCA9ICQoJy5wb3BvdmVyJywgdGhpcy5nZXRQYXJlbnRFbGVtZW50KCkpO1xuXG4gICAgICAgICAgICAgICAgICAgIHRoaXMuYXBwbHlFbGVtZW50T2Zmc2V0KCk7XG5cbiAgICAgICAgICAgICAgICAgICAgdGhpcy5fJGVsZW1lbnQuZmluZCgnLmNsb3NlJylcbiAgICAgICAgICAgICAgICAgICAgICAgIC5vbignY2xpY2snLCAkLnByb3h5KHRoaXMub25DbG9zZUNsaWNrLCB0aGlzKSk7XG4gICAgICAgICAgICAgICAgfSxcblxuICAgICAgICAgICAgICAgIC8qKlxuICAgICAgICAgICAgICAgICAqINCj0LTQsNC70Y/QtdGCINGB0L7QtNC10YDQttC40LzQvtC1INC80LDQutC10YLQsCDQuNC3IERPTS5cbiAgICAgICAgICAgICAgICAgKiBAc2VlIGh0dHBzOi8vYXBpLnlhbmRleC5ydS9tYXBzL2RvYy9qc2FwaS8yLjEvcmVmL3JlZmVyZW5jZS9sYXlvdXQudGVtcGxhdGVCYXNlZC5CYXNlLnhtbCNjbGVhclxuICAgICAgICAgICAgICAgICAqIEBmdW5jdGlvblxuICAgICAgICAgICAgICAgICAqIEBuYW1lIGNsZWFyXG4gICAgICAgICAgICAgICAgICovXG4gICAgICAgICAgICAgICAgY2xlYXI6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5fJGVsZW1lbnQuZmluZCgnLmNsb3NlJylcbiAgICAgICAgICAgICAgICAgICAgICAgIC5vZmYoJ2NsaWNrJyk7XG5cbiAgICAgICAgICAgICAgICAgICAgdGhpcy5jb25zdHJ1Y3Rvci5zdXBlcmNsYXNzLmNsZWFyLmNhbGwodGhpcyk7XG4gICAgICAgICAgICAgICAgfSxcblxuICAgICAgICAgICAgICAgIC8qKlxuICAgICAgICAgICAgICAgICAqINCc0LXRgtC+0LQg0LHRg9C00LXRgiDQstGL0LfQstCw0L0g0YHQuNGB0YLQtdC80L7QuSDRiNCw0LHQu9C+0L3QvtCyINCQ0J/QmCDQv9GA0Lgg0LjQt9C80LXQvdC10L3QuNC4INGA0LDQt9C80LXRgNC+0LIg0LLQu9C+0LbQtdC90L3QvtCz0L4g0LzQsNC60LXRgtCwLlxuICAgICAgICAgICAgICAgICAqIEBzZWUgaHR0cHM6Ly9hcGkueWFuZGV4LnJ1L21hcHMvZG9jL2pzYXBpLzIuMS9yZWYvcmVmZXJlbmNlL0lCYWxsb29uTGF5b3V0LnhtbCNldmVudC11c2VyY2xvc2VcbiAgICAgICAgICAgICAgICAgKiBAZnVuY3Rpb25cbiAgICAgICAgICAgICAgICAgKiBAbmFtZSBvblN1YmxheW91dFNpemVDaGFuZ2VcbiAgICAgICAgICAgICAgICAgKi9cbiAgICAgICAgICAgICAgICBvblN1YmxheW91dFNpemVDaGFuZ2U6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgTXlCYWxsb29uTGF5b3V0LnN1cGVyY2xhc3Mub25TdWJsYXlvdXRTaXplQ2hhbmdlLmFwcGx5KHRoaXMsIGFyZ3VtZW50cyk7XG5cbiAgICAgICAgICAgICAgICAgICAgaWYoIXRoaXMuX2lzRWxlbWVudCh0aGlzLl8kZWxlbWVudCkpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgICAgIHRoaXMuYXBwbHlFbGVtZW50T2Zmc2V0KCk7XG5cbiAgICAgICAgICAgICAgICAgICAgdGhpcy5ldmVudHMuZmlyZSgnc2hhcGVjaGFuZ2UnKTtcbiAgICAgICAgICAgICAgICB9LFxuXG4gICAgICAgICAgICAgICAgLyoqXG4gICAgICAgICAgICAgICAgICog0KHQtNCy0LjQs9Cw0LXQvCDQsdCw0LvRg9C9LCDRh9GC0L7QsdGLIFwi0YXQstC+0YHRgtC40LpcIiDRg9C60LDQt9GL0LLQsNC7INC90LAg0YLQvtGH0LrRgyDQv9GA0LjQstGP0LfQutC4LlxuICAgICAgICAgICAgICAgICAqIEBzZWUgaHR0cHM6Ly9hcGkueWFuZGV4LnJ1L21hcHMvZG9jL2pzYXBpLzIuMS9yZWYvcmVmZXJlbmNlL0lCYWxsb29uTGF5b3V0LnhtbCNldmVudC11c2VyY2xvc2VcbiAgICAgICAgICAgICAgICAgKiBAZnVuY3Rpb25cbiAgICAgICAgICAgICAgICAgKiBAbmFtZSBhcHBseUVsZW1lbnRPZmZzZXRcbiAgICAgICAgICAgICAgICAgKi9cbiAgICAgICAgICAgICAgICBhcHBseUVsZW1lbnRPZmZzZXQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5fJGVsZW1lbnQuY3NzKHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGxlZnQ6IC0odGhpcy5fJGVsZW1lbnRbMF0ub2Zmc2V0V2lkdGggLyAyKSxcbiAgICAgICAgICAgICAgICAgICAgICAgIHRvcDogLSh0aGlzLl8kZWxlbWVudFswXS5vZmZzZXRIZWlnaHQgKyB0aGlzLl8kZWxlbWVudC5maW5kKCcuYXJyb3cnKVswXS5vZmZzZXRIZWlnaHQpXG4gICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgIH0sXG5cbiAgICAgICAgICAgICAgICAvKipcbiAgICAgICAgICAgICAgICAgKiDQl9Cw0LrRgNGL0LLQsNC10YIg0LHQsNC70YPQvSDQv9GA0Lgg0LrQu9C40LrQtSDQvdCwINC60YDQtdGB0YLQuNC6LCDQutC40LTQsNGPINGB0L7QsdGL0YLQuNC1IFwidXNlcmNsb3NlXCIg0L3QsCDQvNCw0LrQtdGC0LUuXG4gICAgICAgICAgICAgICAgICogQHNlZSBodHRwczovL2FwaS55YW5kZXgucnUvbWFwcy9kb2MvanNhcGkvMi4xL3JlZi9yZWZlcmVuY2UvSUJhbGxvb25MYXlvdXQueG1sI2V2ZW50LXVzZXJjbG9zZVxuICAgICAgICAgICAgICAgICAqIEBmdW5jdGlvblxuICAgICAgICAgICAgICAgICAqIEBuYW1lIG9uQ2xvc2VDbGlja1xuICAgICAgICAgICAgICAgICAqL1xuICAgICAgICAgICAgICAgIG9uQ2xvc2VDbGljazogZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgICAgICB0aGlzLmV2ZW50cy5maXJlKCd1c2VyY2xvc2UnKTtcbiAgICAgICAgICAgICAgICB9LFxuXG4gICAgICAgICAgICAgICAgLyoqXG4gICAgICAgICAgICAgICAgICog0JjRgdC/0L7Qu9GM0LfRg9C10YLRgdGPINC00LvRjyDQsNCy0YLQvtC/0L7Qt9C40YbQuNC+0L3QuNGA0L7QstCw0L3QuNGPIChiYWxsb29uQXV0b1BhbikuXG4gICAgICAgICAgICAgICAgICogQHNlZSBodHRwczovL2FwaS55YW5kZXgucnUvbWFwcy9kb2MvanNhcGkvMi4xL3JlZi9yZWZlcmVuY2UvSUxheW91dC54bWwjZ2V0Q2xpZW50Qm91bmRzXG4gICAgICAgICAgICAgICAgICogQGZ1bmN0aW9uXG4gICAgICAgICAgICAgICAgICogQG5hbWUgZ2V0Q2xpZW50Qm91bmRzXG4gICAgICAgICAgICAgICAgICogQHJldHVybnMge051bWJlcltdW119INCa0L7QvtGA0LTQuNC90LDRgtGLINC70LXQstC+0LPQviDQstC10YDRhdC90LXQs9C+INC4INC/0YDQsNCy0L7Qs9C+INC90LjQttC90LXQs9C+INGD0LPQu9C+0LIg0YjQsNCx0LvQvtC90LAg0L7RgtC90L7RgdC40YLQtdC70YzQvdC+INGC0L7Rh9C60Lgg0L/RgNC40LLRj9C30LrQuC5cbiAgICAgICAgICAgICAgICAgKi9cbiAgICAgICAgICAgICAgICAvLyBnZXRTaGFwZTogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIC8vICAgICBpZighdGhpcy5faXNFbGVtZW50KHRoaXMuXyRlbGVtZW50KSkge1xuICAgICAgICAgICAgICAgIC8vICAgICAgICAgcmV0dXJuIE15QmFsbG9vbkxheW91dC5zdXBlcmNsYXNzLmdldFNoYXBlLmNhbGwodGhpcyk7XG4gICAgICAgICAgICAgICAgLy8gICAgIH1cblxuICAgICAgICAgICAgICAgIC8vICAgICB2YXIgcG9zaXRpb24gPSB0aGlzLl8kZWxlbWVudC5wb3NpdGlvbigpO1xuXG4gICAgICAgICAgICAgICAgLy8gICAgIHJldHVybiBuZXcgeW1hcHMuc2hhcGUuUmVjdGFuZ2xlKG5ldyB5bWFwcy5nZW9tZXRyeS5waXhlbC5SZWN0YW5nbGUoW1xuICAgICAgICAgICAgICAgIC8vICAgICAgICAgW3Bvc2l0aW9uLmxlZnQsIHBvc2l0aW9uLnRvcF0sIFtcbiAgICAgICAgICAgICAgICAvLyAgICAgICAgICAgICBwb3NpdGlvbi5sZWZ0ICsgdGhpcy5fJGVsZW1lbnRbMF0ub2Zmc2V0V2lkdGgsXG4gICAgICAgICAgICAgICAgLy8gICAgICAgICAgICAgcG9zaXRpb24udG9wICsgdGhpcy5fJGVsZW1lbnRbMF0ub2Zmc2V0SGVpZ2h0ICsgdGhpcy5fJGVsZW1lbnQuZmluZCgnLmFycm93JylbMF0ub2Zmc2V0SGVpZ2h0XG4gICAgICAgICAgICAgICAgLy8gICAgICAgICBdXG4gICAgICAgICAgICAgICAgLy8gICAgIF0pKTtcbiAgICAgICAgICAgICAgICAvLyB9LFxuXG4gICAgICAgICAgICAgICAgLyoqXG4gICAgICAgICAgICAgICAgICog0J/RgNC+0LLQtdGA0Y/QtdC8INC90LDQu9C40YfQuNC1INGN0LvQtdC80LXQvdGC0LAgKNCyINCY0JUg0Lgg0J7Qv9C10YDQtSDQtdCz0L4g0LXRidC1INC80L7QttC10YIg0L3QtSDQsdGL0YLRjCkuXG4gICAgICAgICAgICAgICAgICogQGZ1bmN0aW9uXG4gICAgICAgICAgICAgICAgICogQHByaXZhdGVcbiAgICAgICAgICAgICAgICAgKiBAbmFtZSBfaXNFbGVtZW50XG4gICAgICAgICAgICAgICAgICogQHBhcmFtIHtqUXVlcnl9IFtlbGVtZW50XSDQrdC70LXQvNC10L3Rgi5cbiAgICAgICAgICAgICAgICAgKiBAcmV0dXJucyB7Qm9vbGVhbn0g0KTQu9Cw0LMg0L3QsNC70LjRh9C40Y8uXG4gICAgICAgICAgICAgICAgICovXG4gICAgICAgICAgICAgICAgX2lzRWxlbWVudDogZnVuY3Rpb24gKGVsZW1lbnQpIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGVsZW1lbnQgJiYgZWxlbWVudFswXSAmJiBlbGVtZW50LmZpbmQoJy5hcnJvdycpWzBdO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pLFxuXG4gICAgICAgIC8vINCh0L7Qt9C00LDQvdC40LUg0LLQu9C+0LbQtdC90L3QvtCz0L4g0LzQsNC60LXRgtCwINGB0L7QtNC10YDQttC40LzQvtCz0L4g0LHQsNC70YPQvdCwLlxuICAgICAgICBNeUJhbGxvb25Db250ZW50TGF5b3V0ID0geW1hcHMudGVtcGxhdGVMYXlvdXRGYWN0b3J5LmNyZWF0ZUNsYXNzKFxuICAgICAgICAgICAgJzxoMyBjbGFzcz1cInBvcG92ZXItdGl0bGVcIj4kW3Byb3BlcnRpZXMuYmFsbG9vbkhlYWRlcl08L2gzPicgK1xuICAgICAgICAgICAgICAgICc8ZGl2IGNsYXNzPVwicG9wb3Zlci1jb250ZW50XCI+JFtwcm9wZXJ0aWVzLmJhbGxvb25Db250ZW50XTwvZGl2PidcbiAgICAgICAgKSxcblxuICAgICAgICAvLyDQodC+0LfQtNCw0L3QuNC1INC80LXRgtC60Lgg0YEg0L/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC40Lwg0LzQsNC60LXRgtC+0Lwg0LHQsNC70YPQvdCwLlxuICAgICAgICBteVBsYWNlbWFyayA9IHdpbmRvdy5teVBsYWNlbWFyayA9IG5ldyB5bWFwcy5QbGFjZW1hcmsobXlNYXAuZ2V0Q2VudGVyKCksIHtcbiAgICAgICAgICAgIGJhbGxvb25IZWFkZXI6ICfQptC10L3RgtGAINGB0LvRg9GF0LAg0L3QsCDRg9C7LiDQnNCw0LrQsNGC0LDQtdCy0LAsIDE4JyxcbiAgICAgICAgICAgIGJhbGxvb25Db250ZW50OiAnPHVsPjxsaT48c3Bhbj7QkNC00YDQtdGBPC9zcGFuPjxzcGFuPjkwMDUyNCwg0JDQu9C80LAt0JDRgtCwLCDRg9C7LiDQkdC+0LPQtdC90LHQsNC5INCR0LDRgtGL0YDQsCwgMTM0PC9zcGFuPjwvbGk+PGxpPjxzcGFuPtCS0YDQtdC80Y8g0YDQsNCx0L7RgtGLPC9zcGFuPjxzcGFuPtCf0L0t0J/RgjogODowMC0yMDowMDxicj7QktGL0YXQvtC00L3Ri9C1OiDQodCxLCDQktGBPC9zcGFuPjwvbGk+PGxpPjxzcGFuPtCi0LXQu9C10YTQvtC9PC9zcGFuPjxzcGFuPis3ICg5MDApIDIzMi0yMy0yMzwvc3Bhbj48L2xpPjxsaT48c3Bhbj7QrdC70LXQutGC0YDQvtC90L3QsNGPINC/0L7Rh9GC0LA8L3NwYW4+PHNwYW4+a2F6YWhzdGFuQGF1ZGlvdGVjaC5ydTwvc3Bhbj48L2xpPjxsaSBjbGFzcz1cInBvcG92ZXJfX2Zvb3RlclwiPjxhIGNsYXNzPVwiYnRuIGJ0bi0taWNuIGJ0bi0tcmVkIGJ0bi0tbVwiIGhyZWY9XCIjXCIgZGF0YS10YXJnZXQ9XCJtb2RhbC1yZWdcIj48c3ZnIHdpZHRoPVwiMjRcIiBoZWlnaHQ9XCIyNFwiIHZpZXdCb3g9XCIwIDAgMjQgMjRcIiBmaWxsPVwibm9uZVwiIHhtbG5zPVwiaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmdcIj48cGF0aCBmaWxsLXJ1bGU9XCJldmVub2RkXCIgY2xpcC1ydWxlPVwiZXZlbm9kZFwiIGQ9XCJNOCAyQzguNTUyMjggMiA5IDIuNDQ3NzIgOSAzVjRIMTVWM0MxNSAyLjQ0NzcyIDE1LjQ0NzcgMiAxNiAyQzE2LjU1MjMgMiAxNyAyLjQ0NzcyIDE3IDNWNEgxOUMxOS43OTU3IDQgMjAuNTU4NyA0LjMxNjA3IDIxLjEyMTMgNC44Nzg2OEMyMS42ODM5IDUuNDQxMjkgMjIgNi4yMDQzNSAyMiA3VjE5QzIyIDE5Ljc5NTcgMjEuNjgzOSAyMC41NTg3IDIxLjEyMTMgMjEuMTIxM0MyMC41NTg3IDIxLjY4MzkgMTkuNzk1NyAyMiAxOSAyMkg1QzQuMjA0MzUgMjIgMy40NDEyOSAyMS42ODM5IDIuODc4NjggMjEuMTIxM0MyLjMxNjA3IDIwLjU1ODcgMiAxOS43OTU3IDIgMTlWN0MyIDYuMjA0MzUgMi4zMTYwNyA1LjQ0MTI5IDIuODc4NjggNC44Nzg2OEMzLjQ0MTI5IDQuMzE2MDcgNC4yMDQzNSA0IDUgNEg3VjNDNyAyLjQ0NzcyIDcuNDQ3NzIgMiA4IDJaTTcgNkg1QzQuNzM0NzggNiA0LjQ4MDQzIDYuMTA1MzYgNC4yOTI4OSA2LjI5Mjg5QzQuMTA1MzYgNi40ODA0MyA0IDYuNzM0NzggNCA3VjE5QzQgMTkuMjY1MiA0LjEwNTM2IDE5LjUxOTYgNC4yOTI4OSAxOS43MDcxQzQuNDgwNDMgMTkuODk0NiA0LjczNDc4IDIwIDUgMjBIMTlDMTkuMjY1MiAyMCAxOS41MTk2IDE5Ljg5NDYgMTkuNzA3MSAxOS43MDcxQzE5Ljg5NDYgMTkuNTE5NiAyMCAxOS4yNjUyIDIwIDE5VjdDMjAgNi43MzQ3OCAxOS44OTQ2IDYuNDgwNDMgMTkuNzA3MSA2LjI5Mjg5QzE5LjUxOTYgNi4xMDUzNiAxOS4yNjUyIDYgMTkgNkgxN1Y3QzE3IDcuNTUyMjggMTYuNTUyMyA4IDE2IDhDMTUuNDQ3NyA4IDE1IDcuNTUyMjggMTUgN1Y2SDlWN0M5IDcuNTUyMjggOC41NTIyOCA4IDggOEM3LjQ0NzcyIDggNyA3LjU1MjI4IDcgN1Y2WlwiIGZpbGw9XCJ3aGl0ZVwiPjwvcGF0aD48cGF0aCBkPVwiTTkgMTFDOSAxMS41NTIzIDguNTUyMjggMTIgOCAxMkM3LjQ0NzcyIDEyIDcgMTEuNTUyMyA3IDExQzcgMTAuNDQ3NyA3LjQ0NzcyIDEwIDggMTBDOC41NTIyOCAxMCA5IDEwLjQ0NzcgOSAxMVpcIiBmaWxsPVwid2hpdGVcIj48L3BhdGg+PHBhdGggZD1cIk05IDE1QzkgMTUuNTUyMyA4LjU1MjI4IDE2IDggMTZDNy40NDc3MiAxNiA3IDE1LjU1MjMgNyAxNUM3IDE0LjQ0NzcgNy40NDc3MiAxNCA4IDE0QzguNTUyMjggMTQgOSAxNC40NDc3IDkgMTVaXCIgZmlsbD1cIndoaXRlXCI+PC9wYXRoPjxwYXRoIGQ9XCJNMTMgMTFDMTMgMTEuNTUyMyAxMi41NTIzIDEyIDEyIDEyQzExLjQ0NzcgMTIgMTEgMTEuNTUyMyAxMSAxMUMxMSAxMC40NDc3IDExLjQ0NzcgMTAgMTIgMTBDMTIuNTUyMyAxMCAxMyAxMC40NDc3IDEzIDExWlwiIGZpbGw9XCJ3aGl0ZVwiPjwvcGF0aD48cGF0aCBkPVwiTTEzIDE1QzEzIDE1LjU1MjMgMTIuNTUyMyAxNiAxMiAxNkMxMS40NDc3IDE2IDExIDE1LjU1MjMgMTEgMTVDMTEgMTQuNDQ3NyAxMS40NDc3IDE0IDEyIDE0QzEyLjU1MjMgMTQgMTMgMTQuNDQ3NyAxMyAxNVpcIiBmaWxsPVwid2hpdGVcIj48L3BhdGg+PHBhdGggZD1cIk0xNyAxMUMxNyAxMS41NTIzIDE2LjU1MjMgMTIgMTYgMTJDMTUuNDQ3NyAxMiAxNSAxMS41NTIzIDE1IDExQzE1IDEwLjQ0NzcgMTUuNDQ3NyAxMCAxNiAxMEMxNi41NTIzIDEwIDE3IDEwLjQ0NzcgMTcgMTFaXCIgZmlsbD1cIndoaXRlXCI+PC9wYXRoPjwvc3ZnPtCX0LDQv9C40YHQsNGC0YzRgdGPINC90LAg0L/RgNC40ZHQvDwvYT48L2xpPjwvdWw+J1xuICAgICAgICB9LCB7XG4gICAgICAgICAgICBiYWxsb29uU2hhZG93OiBmYWxzZSxcbiAgICAgICAgICAgIGJhbGxvb25MYXlvdXQ6IE15QmFsbG9vbkxheW91dCxcbiAgICAgICAgICAgIGJhbGxvb25Db250ZW50TGF5b3V0OiBNeUJhbGxvb25Db250ZW50TGF5b3V0LFxuICAgICAgICAgICAgYmFsbG9vblBhbmVsTWF4TWFwQXJlYTogMCxcbiAgICAgICAgICAgIC8vINCd0LUg0YHQutGA0YvQstCw0LXQvCDQuNC60L7QvdC60YMg0L/RgNC4INC+0YLQutGA0YvRgtC+0Lwg0LHQsNC70YPQvdC1LlxuICAgICAgICAgICAgaGlkZUljb25PbkJhbGxvb25PcGVuOiBmYWxzZSxcbiAgICAgICAgICAgIC8vINCYINC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdC+INGB0LzQtdGJ0LDQtdC8INCx0LDQu9GD0L0sINC00LvRjyDQvtGC0LrRgNGL0YLQuNGPINC90LDQtCDQuNC60L7QvdC60L7QuS5cbiAgICAgICAgICAgIC8vIGJhbGxvb25PZmZzZXQ6IFszLCAtNDBdXG4gICAgICAgICAgICAvLyDQndC10L7QsdGF0L7QtNC40LzQviDRg9C60LDQt9Cw0YLRjCDQtNCw0L3QvdGL0Lkg0YLQuNC/INC80LDQutC10YLQsC5cbiAgICAgICAgICAgIGljb25MYXlvdXQ6ICdkZWZhdWx0I2ltYWdlJyxcbiAgICAgICAgICAgIC8vINCh0LLQvtGRINC40LfQvtCx0YDQsNC20LXQvdC40LUg0LjQutC+0L3QutC4INC80LXRgtC60LguXG4gICAgICAgICAgICBpY29uSW1hZ2VIcmVmOiAnaW1nL2ljbnMvc20tbG9jYXRpb24tbWFya2VyLnN2ZycsXG4gICAgICAgICAgICAvLyDQoNCw0LfQvNC10YDRiyDQvNC10YLQutC4LlxuICAgICAgICAgICAgaWNvbkltYWdlU2l6ZTogWzMyLCAzMl0sXG4gICAgICAgICAgICAvLyDQodC80LXRidC10L3QuNC1INC70LXQstC+0LPQviDQstC10YDRhdC90LXQs9C+INGD0LPQu9CwINC40LrQvtC90LrQuCDQvtGC0L3QvtGB0LjRgtC10LvRjNC90L5cbiAgICAgICAgICAgIC8vINC10ZEgXCLQvdC+0LbQutC4XCIgKNGC0L7Rh9C60Lgg0L/RgNC40LLRj9C30LrQuCkuXG4gICAgICAgICAgICBoaWRlSWNvbk9uQmFsbG9vbk9wZW46IGZhbHNlLFxuICAgICAgICAgICAgaWNvbkltYWdlT2Zmc2V0OiBbLTUsIC0zOF1cbiAgICAgICAgfSksXG4gICAgICAgIG15UGxhY2VtYXJrMiA9IHdpbmRvdy5teVBsYWNlbWFyayA9IG5ldyB5bWFwcy5QbGFjZW1hcmsoWzU1LjY3Njc1NCwgMzcuODkzMzI0XSwge1xuICAgICAgICAgICAgYmFsbG9vbkhlYWRlcjogJ9Cf0L7Rh9GC0L7QstC+0LUg0L7RgtC00LXQu9C10L3QuNC1IDkwMDUyNCcsXG4gICAgICAgICAgICBiYWxsb29uQ29udGVudDogJzx1bD48bGk+PHNwYW4+0JDQtNGA0LXRgTwvc3Bhbj48c3Bhbj45MDA1MjQsINCQ0LvQvNCwLdCQ0YLQsCwg0YPQuy4g0JHQvtCz0LXQvdCx0LDQuSDQkdCw0YLRi9GA0LAsIDEzNDwvc3Bhbj48L2xpPjxsaT48c3Bhbj7QktGA0LXQvNGPINGA0LDQsdC+0YLRizwvc3Bhbj48c3Bhbj7Qn9C9LdCf0YI6IDg6MDAtMjA6MDA8YnI+0JLRi9GF0L7QtNC90YvQtTog0KHQsSwg0JLRgTwvc3Bhbj48L2xpPjxsaT48c3Bhbj7QntC/0LvQsNGC0LA8L3NwYW4+PHNwYW4+0LrQsNGA0YLQsCwg0L3QsNC70LjRh9C90YvQtTwvc3Bhbj48L2xpPjxsaSBjbGFzcz1cInBvcG92ZXJfX2Zvb3RlclwiPjxzcGFuPtCU0L7RgdGC0LDQstC60LA8L3NwYW4+PHNwYW4+0L7RgiAyINC00L3QtdC5IC8gMzAwIOKCvTwvc3Bhbj48L2xpPjwvdWw+J1xuICAgICAgICB9LCB7XG4gICAgICAgICAgICBiYWxsb29uU2hhZG93OiBmYWxzZSxcbiAgICAgICAgICAgIGJhbGxvb25MYXlvdXQ6IE15QmFsbG9vbkxheW91dCxcbiAgICAgICAgICAgIGJhbGxvb25Db250ZW50TGF5b3V0OiBNeUJhbGxvb25Db250ZW50TGF5b3V0LFxuICAgICAgICAgICAgYmFsbG9vblBhbmVsTWF4TWFwQXJlYTogMCxcbiAgICAgICAgICAgIC8vINCd0LUg0YHQutGA0YvQstCw0LXQvCDQuNC60L7QvdC60YMg0L/RgNC4INC+0YLQutGA0YvRgtC+0Lwg0LHQsNC70YPQvdC1LlxuICAgICAgICAgICAgaGlkZUljb25PbkJhbGxvb25PcGVuOiBmYWxzZSxcbiAgICAgICAgICAgIC8vINCYINC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdC+INGB0LzQtdGJ0LDQtdC8INCx0LDQu9GD0L0sINC00LvRjyDQvtGC0LrRgNGL0YLQuNGPINC90LDQtCDQuNC60L7QvdC60L7QuS5cbiAgICAgICAgICAgIC8vIGJhbGxvb25PZmZzZXQ6IFszLCAtNDBdXG4gICAgICAgICAgICAvLyDQndC10L7QsdGF0L7QtNC40LzQviDRg9C60LDQt9Cw0YLRjCDQtNCw0L3QvdGL0Lkg0YLQuNC/INC80LDQutC10YLQsC5cbiAgICAgICAgICAgIGljb25MYXlvdXQ6ICdkZWZhdWx0I2ltYWdlJyxcbiAgICAgICAgICAgIC8vINCh0LLQvtGRINC40LfQvtCx0YDQsNC20LXQvdC40LUg0LjQutC+0L3QutC4INC80LXRgtC60LguXG4gICAgICAgICAgICBpY29uSW1hZ2VIcmVmOiAnaW1nL2ljbnMvc20tbG9jYXRpb24tbWFya2VyLnN2ZycsXG4gICAgICAgICAgICAvLyDQoNCw0LfQvNC10YDRiyDQvNC10YLQutC4LlxuICAgICAgICAgICAgaWNvbkltYWdlU2l6ZTogWzMyLCAzMl0sXG4gICAgICAgICAgICAvLyDQodC80LXRidC10L3QuNC1INC70LXQstC+0LPQviDQstC10YDRhdC90LXQs9C+INGD0LPQu9CwINC40LrQvtC90LrQuCDQvtGC0L3QvtGB0LjRgtC10LvRjNC90L5cbiAgICAgICAgICAgIC8vINC10ZEgXCLQvdC+0LbQutC4XCIgKNGC0L7Rh9C60Lgg0L/RgNC40LLRj9C30LrQuCkuXG4gICAgICAgICAgICBoaWRlSWNvbk9uQmFsbG9vbk9wZW46IGZhbHNlLFxuICAgICAgICAgICAgaWNvbkltYWdlT2Zmc2V0OiBbLTUsIC0zOF1cbiAgICAgICAgfSk7XG5cbiAgICBteU1hcC5nZW9PYmplY3RzLmFkZChteVBsYWNlbWFyayksXG4gICAgbXlNYXAuZ2VvT2JqZWN0cy5hZGQobXlQbGFjZW1hcmsyKTtcbn0pOyJdLCJmaWxlIjoiYmFsbG9vbl9odG1sLW1hcC5qcyJ9
} catch (e) {
    console.log(e);
}