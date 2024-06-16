class CMap{
    constructor(ya_map, map_id, options){
        if (typeof(ya_map) == 'undefined' || !map_id){
            return false;
        }

        this.options = options;
        this.ya_map = ya_map;
        this.map_id = map_id;
        this.map = null;
        this.clusterer = null;

        this.arPlacemarks = [];
        this.placemarkContentLayout = null;

        this.ya_map.ready(() => {
            this.initMap();
        });
    }

    initMap(){
        this.map = new this.ya_map.Map(this.map_id, {
            center: this.options['CENTER'] ? this.options['CENTER'] : [43.261026, 76.945600],
            zoom: this.options['ZOOM'] ? this.options['ZOOM'] : 15,
            behaviors: ['default', 'scrollZoom'],
            controls: [],
        });
        this.clusterer = new this.ya_map.Clusterer();

        this.placemarkContentLayout = this.createPlacemarkContentLayout();
    }

    createPlacemarkContentLayout(){
        return this.ya_map.templateLayoutFactory.createClass(
            '<div class="popover top">' + //style="top:40px !important; left: 40px !important;"
            '<a class="close" href="javascript:void(0)" onclick="deliveryMap.closeBaloon(this);return false;" data-close="Y">' +
            '<img src="/local/templates/audiotech/images/icns/md-x.svg"></a>' +
            '<div class="arrow"></div>' +
            '<div class="popover-inner">' +
            '<h3 class="popover-title">{{ properties.balloonHeader }}</h3>' +
            '<div class="popover-content">{{ properties.balloonContent|raw }}</div>'+
            '</div>' +
            '</div>'
            ,{
                build: function() {
                    this.constructor.superclass.build.call(this);
                },
                clear: function() {
                    this.constructor.superclass.clear.call(this);
                },
                onCloseClick: function (e) {
                    e.preventDefault();
                    this.events.fire('userclose');
                },
            }
        );
    }

    addPlacemarks(_items){
        if (!_items || !_items.length){
            return false;
        }

        this.ya_map.ready(() => {
            this.arPlacemarks = [];
            for(let i=0; i < _items.length; i++){
                this.addPlacemark(_items[i]);
            }

            if (this.arPlacemarks){
                this.clusterer.add(this.arPlacemarks);
                this.map.geoObjects.add(this.clusterer);
            }
        });
    }

    addPlacemark(_data){
        if (!_data){
            return false;
        }

        let myPlacemark = new this.ya_map.Placemark(_data.COORDS, {
            // balloonHeader: _data.NAME,
            balloonContent: this.getBalloonContent({
                title   : _data.NAME,
                body    : this.getPlacemarkHTML(_data)
            }),
        }, {
            balloonOffset: [-140, -180],
            balloonShadow: false,
            //balloonLayout: this.placemarkLayout,
            //balloonContentLayout: this.placemarkContentLayout,
            balloonPanelMaxMapArea: 0,
            // Не скрываем иконку при открытом балуне.
            hideIconOnBalloonOpen: false,
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '/local/templates/audiotech/images/icns/sm-location-marker.svg',
            // Размеры метки.
            iconImageSize: [32, 32],
            hideIconOnBalloonOpen: false,
            iconImageOffset: [-16, -16]
        });

        if (!this.clusterer){
            this.map.geoObjects.add(myPlacemark);
        }else{
            this.arPlacemarks.push(myPlacemark);
        }
    }

    getPlacemarkHTML(_data){
        if (!_data){
            return false;
        }
        let html= '<ul>';

        if (_data.INDEX || _data.INDEX_NEW){
            html += `<li><span>Индекс</span><span>`;
            if (!_data.INDEX || !_data.INDEX_NEW){
                html += _data.INDEX ? _data.INDEX : _data.INDEX_NEW;
            }else{
                html += _data.INDEX + ' / ' + _data.INDEX_NEW;
            }
            html += `</span></li>`;
        }

        if (_data.ADDRESS){
            html += `<li><span>Адрес</span><span>${_data.ADDRESS}</span></li>`;
        }
        if (_data.SCHEDULE){
            html += `<li><span>Время работы</span><span>${_data.SCHEDULE}</span></li>`;
        }
        if (_data.PHONE){
            html += `<li><span>Телефон</span><span><a href="tel:${this.clearPhone(_data.PHONE)}" target="_blank">${_data.PHONE}</a></span></li>`;
        }
        if (_data.EMAIL){
            html += `<li><span>Электронная почта</span><span><a href="mailto:${_data.EMAIL}" target="_blank">${_data.EMAIL}</a></span></li>`;
        }
        if (_data.PAYMENT){
            html += `<li><span>Оплата</span><span>${_data.PAYMENT}</span></li>`;
        }
        if (_data.DELIVERY){
            let label = _data.DELIVERY_LABEL ? _data.DELIVERY_LABEL : 'Доставка';
            html += `<li><span class="popover__footer">${label}</span><span>${_data.DELIVERY}</span></li>`;
        }

        return html + '</ul>';
    }

    getBalloonContent(data){
        return '<div class="popover top">'+
            '<div class="popover-inner">' +
            '<h3 class="popover-title">' + data['title'] + '</h3>' +
            '<div class="popover-content">' + data['body'] + '</div>'+
            '</div>' +
            '</div>';
    }

    clearPhone(phone){
        return phone.replace(/\D/, '');
    }

    closeBaloon(){
        let closeButton = document.querySelector('[class*="balloon__close-button"]');

        if (closeButton){
            closeButton.click();
        }
    }
}

class SwitchTabs{
    constructor(_map, placemarks, centers){
        if (!_map || placemarks == undefined){
            return false;
        }
        this.map = _map;
        this.centers = centers;

        this.placemarks = placemarks;
        this.class_name = 'chips__item';
        this.active_class_name = 'active-tab';
        this.setTabsEvents();
    }

    setTabsEvents(){
        let tabs = document.querySelectorAll(`.${this.class_name}`);

        if (!tabs.length){
            return false;
        }

        for(let i = 0; i < tabs.length; i++){
            tabs[i].addEventListener('click', (event) => {
                let _this = event.currentTarget,
                    tab_code = _this.dataset.code;

                if (!_this.classList.contains(this.active_class_name)){
                    document.querySelector(`.${this.active_class_name}`).
                            classList.remove(this.active_class_name);
                    this.map.clusterer.removeAll();
                    if (this.placemarks[tab_code] != undefined){
                        this.map.addPlacemarks(this.placemarks[tab_code]);

                        if (this.centers[tab_code]){
                            this.goTo(
                                this.centers[tab_code]['COORDS'],
                                this.centers[tab_code]['ZOOM']
                            );
                        }
                    }
                    _this.classList.add(this.active_class_name);
                }
            });
        }
    }

    goTo(coords, zoom){
        if (!coords.length || !zoom){
            return false;
        }

        this.map.map.setCenter(coords, zoom);
    }
}
