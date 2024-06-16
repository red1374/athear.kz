window.addEventListener('DOMContentLoaded', () => {
	window.SmartFilter = function (urlPage) {
		this.urlPage = urlPage;
		this.clearUrl = 'filter/clear/apply/';
		this.form = $('#form-filter');

		this.inputCheckbox = this.form.find('input[type=checkbox]');
		this.inputRadio = this.form.find('input[type=radio]');

		this.inputCheckbox.on('change', this.dataChanged.bind(this));
		this.inputRadio.on('change', this.dataChanged.bind(this));
	};

	SmartFilter.prototype.dataChanged = function (event) {
		if (event.target.type == 'radio')
		{
			let box = event.target.parentNode.parentNode;
			let boxValue = box.querySelectorAll('.input-action');

			boxValue.forEach(item => {
				item.checked = false;
			});

			event.target.checked = true;
		}

		var formData = {ajax: 'y'};
		this.form.serializeArray().forEach(function (element) {
			if (element.value) {
				formData[element.name] = element.value;
			}
		});
		this.ajaxRequest(formData);
	};

	SmartFilter.prototype.ajaxRequest = function (data) {
		BX.ajax.loadJSON(
			this.urlPage,
			data,
			this.filterApply.bind(this)
		);
	};

	SmartFilter.prototype.filterApply = function (resultData) {
		let url = resultData.FILTER_AJAX_URL;

		url = this.clearUrlEmptyFilter(url).replace(new RegExp(`\\bamp;[a-z]*\\b`, 'ig'), '');

		// Реализация отображения фильтра в адресной строке
		window.history.pushState(null, null, url);

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				pageType: 'AJAX',
				action: 'filterApply'
			},
			dataType: 'HTML'
		})
			.done(function (result) {
				if (window.innerWidth > 940) {
					let div = document.createElement('div');
					div.innerHTML = result;
					document.querySelector('#catalogAjax').innerHTML = div.querySelector('#catalogAjax').innerHTML;
					document.querySelector('.clear-filter').style.display = 'flex';
				} else {
					document.querySelector('.filter-btn').style.display = 'flex';
				}
			});
	};

	SmartFilter.prototype.clearUrlEmptyFilter = function (url) {
		if (url.indexOf(this.clearUrl) !== -1) {
			url = url.replace(this.clearUrl, '');
		}

		return url;
	};
});