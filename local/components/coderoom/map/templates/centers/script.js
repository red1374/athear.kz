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
            balloonHeight:'105%',
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
        console.log(_data);
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
        if (_data.SHOW_SIGNIN && _data.SHOW_SIGNIN == 'Y'){
            html += `<li class="popover__footer"><a class="btn btn--icn btn--red btn--m" href="#" data-target="modal-reg"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C8.55228 2 9 2.44772 9 3V4H15V3C15 2.44772 15.4477 2 16 2C16.5523 2 17 2.44772 17 3V4H19C19.7957 4 20.5587 4.31607 21.1213 4.87868C21.6839 5.44129 22 6.20435 22 7V19C22 19.7957 21.6839 20.5587 21.1213 21.1213C20.5587 21.6839 19.7957 22 19 22H5C4.20435 22 3.44129 21.6839 2.87868 21.1213C2.31607 20.5587 2 19.7957 2 19V7C2 6.20435 2.31607 5.44129 2.87868 4.87868C3.44129 4.31607 4.20435 4 5 4H7V3C7 2.44772 7.44772 2 8 2ZM7 6H5C4.73478 6 4.48043 6.10536 4.29289 6.29289C4.10536 6.48043 4 6.73478 4 7V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H19C19.2652 20 19.5196 19.8946 19.7071 19.7071C19.8946 19.5196 20 19.2652 20 19V7C20 6.73478 19.8946 6.48043 19.7071 6.29289C19.5196 6.10536 19.2652 6 19 6H17V7C17 7.55228 16.5523 8 16 8C15.4477 8 15 7.55228 15 7V6H9V7C9 7.55228 8.55228 8 8 8C7.44772 8 7 7.55228 7 7V6Z" fill="white"></path><path d="M9 11C9 11.5523 8.55228 12 8 12C7.44772 12 7 11.5523 7 11C7 10.4477 7.44772 10 8 10C8.55228 10 9 10.4477 9 11Z" fill="white"></path><path d="M9 15C9 15.5523 8.55228 16 8 16C7.44772 16 7 15.5523 7 15C7 14.4477 7.44772 14 8 14C8.55228 14 9 14.4477 9 15Z" fill="white"></path><path d="M13 11C13 11.5523 12.5523 12 12 12C11.4477 12 11 11.5523 11 11C11 10.4477 11.4477 10 12 10C12.5523 10 13 10.4477 13 11Z" fill="white"></path><path d="M13 15C13 15.5523 12.5523 16 12 16C11.4477 16 11 15.5523 11 15C11 14.4477 11.4477 14 12 14C12.5523 14 13 14.4477 13 15Z" fill="white"></path><path d="M17 11C17 11.5523 16.5523 12 16 12C15.4477 12 15 11.5523 15 11C15 10.4477 15.4477 10 16 10C16.5523 10 17 10.4477 17 11Z" fill="white"></path></svg>Записаться на приём</a></li>`;
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