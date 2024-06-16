class ItcTabs {
    constructor(target, config) {
        const defaultConfig = {};
        this._config = Object.assign(defaultConfig, config);
        this._elTabs = typeof target === 'string' ? document.querySelector(target) : target;
        this._elButtons = this._elTabs.querySelectorAll('.tabs__btn');
        this._elPanes = this._elTabs.querySelectorAll('.tabs__pane');
        this._eventShow = new Event('tab.itc.change');
        this._init();
        this._events();
    }
    _init() {
        this._elTabs.setAttribute('role', 'tablist');
        this._elButtons.forEach((el, index) => {
            el.dataset.index = index;
            el.setAttribute('role', 'tab');
            if (this._elPanes.length && index < this._elPanes.length){
                this._elPanes[index].setAttribute('role', 'tabpanel');
            }
        });
    }
    show(elLinkTarget) {
        const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
        const elLinkActive = this._elTabs.querySelector('.active');
        const elPaneShow = this._elTabs.querySelector('.show');
        if (elLinkTarget.href && !elLinkTarget.href.match('#') && elLinkTarget.href != window.location.href){
            window.location.href = elLinkTarget.href;
            return true;
        }
        if (elLinkTarget === elLinkActive) {
            return;
        }
        elLinkActive ? elLinkActive.classList.remove('active') : null;
        elPaneShow ? elPaneShow.classList.remove('show') : null;
        elLinkTarget.classList.add('active');
        elPaneTarget.classList.add('show');
        this._elTabs.dispatchEvent(this._eventShow);
        elLinkTarget.focus();
    }
    showByIndex(index) {
        const elLinkTarget = this._elButtons[index];
        elLinkTarget ? this.show(elLinkTarget) : null;
    };
    _events() {
        this._elTabs.addEventListener('click', (e) => {
            const target = e.target.closest('.tabs__btn');
            if (target) {
                e.preventDefault();
                this.show(target);
            }
        });
    }
}
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJ0YWJzLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImNsYXNzIEl0Y1RhYnMge1xuICAgIGNvbnN0cnVjdG9yKHRhcmdldCwgY29uZmlnKSB7XG4gICAgICAgIGNvbnN0IGRlZmF1bHRDb25maWcgPSB7fTtcbiAgICAgICAgdGhpcy5fY29uZmlnID0gT2JqZWN0LmFzc2lnbihkZWZhdWx0Q29uZmlnLCBjb25maWcpO1xuICAgICAgICB0aGlzLl9lbFRhYnMgPSB0eXBlb2YgdGFyZ2V0ID09PSAnc3RyaW5nJyA/IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IodGFyZ2V0KSA6IHRhcmdldDtcbiAgICAgICAgdGhpcy5fZWxCdXR0b25zID0gdGhpcy5fZWxUYWJzLnF1ZXJ5U2VsZWN0b3JBbGwoJy50YWJzX19idG4nKTtcbiAgICAgICAgdGhpcy5fZWxQYW5lcyA9IHRoaXMuX2VsVGFicy5xdWVyeVNlbGVjdG9yQWxsKCcudGFic19fcGFuZScpO1xuICAgICAgICB0aGlzLl9ldmVudFNob3cgPSBuZXcgRXZlbnQoJ3RhYi5pdGMuY2hhbmdlJyk7XG4gICAgICAgIHRoaXMuX2luaXQoKTtcbiAgICAgICAgdGhpcy5fZXZlbnRzKCk7XG4gICAgfVxuICAgIF9pbml0KCkge1xuICAgICAgICB0aGlzLl9lbFRhYnMuc2V0QXR0cmlidXRlKCdyb2xlJywgJ3RhYmxpc3QnKTtcbiAgICAgICAgdGhpcy5fZWxCdXR0b25zLmZvckVhY2goKGVsLCBpbmRleCkgPT4ge1xuICAgICAgICAgICAgZWwuZGF0YXNldC5pbmRleCA9IGluZGV4O1xuICAgICAgICAgICAgZWwuc2V0QXR0cmlidXRlKCdyb2xlJywgJ3RhYicpO1xuICAgICAgICAgICAgdGhpcy5fZWxQYW5lc1tpbmRleF0uc2V0QXR0cmlidXRlKCdyb2xlJywgJ3RhYnBhbmVsJyk7XG4gICAgICAgIH0pO1xuICAgIH1cbiAgICBzaG93KGVsTGlua1RhcmdldCkge1xuICAgICAgICBjb25zdCBlbFBhbmVUYXJnZXQgPSB0aGlzLl9lbFBhbmVzW2VsTGlua1RhcmdldC5kYXRhc2V0LmluZGV4XTtcbiAgICAgICAgY29uc3QgZWxMaW5rQWN0aXZlID0gdGhpcy5fZWxUYWJzLnF1ZXJ5U2VsZWN0b3IoJy5hY3RpdmUnKTtcbiAgICAgICAgY29uc3QgZWxQYW5lU2hvdyA9IHRoaXMuX2VsVGFicy5xdWVyeVNlbGVjdG9yKCcuc2hvdycpO1xuICAgICAgICBpZiAoZWxMaW5rVGFyZ2V0ID09PSBlbExpbmtBY3RpdmUpIHtcbiAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgfVxuICAgICAgICBlbExpbmtBY3RpdmUgPyBlbExpbmtBY3RpdmUuY2xhc3NMaXN0LnJlbW92ZSgnYWN0aXZlJykgOiBudWxsO1xuICAgICAgICBlbFBhbmVTaG93ID8gZWxQYW5lU2hvdy5jbGFzc0xpc3QucmVtb3ZlKCdzaG93JykgOiBudWxsO1xuICAgICAgICBlbExpbmtUYXJnZXQuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG4gICAgICAgIGVsUGFuZVRhcmdldC5jbGFzc0xpc3QuYWRkKCdzaG93Jyk7XG4gICAgICAgIHRoaXMuX2VsVGFicy5kaXNwYXRjaEV2ZW50KHRoaXMuX2V2ZW50U2hvdyk7XG4gICAgICAgIGVsTGlua1RhcmdldC5mb2N1cygpO1xuICAgIH1cbiAgICBzaG93QnlJbmRleChpbmRleCkge1xuICAgICAgICBjb25zdCBlbExpbmtUYXJnZXQgPSB0aGlzLl9lbEJ1dHRvbnNbaW5kZXhdO1xuICAgICAgICBlbExpbmtUYXJnZXQgPyB0aGlzLnNob3coZWxMaW5rVGFyZ2V0KSA6IG51bGw7XG4gICAgfTtcbiAgICBfZXZlbnRzKCkge1xuICAgICAgICB0aGlzLl9lbFRhYnMuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZSkgPT4ge1xuICAgICAgICAgICAgY29uc3QgdGFyZ2V0ID0gZS50YXJnZXQuY2xvc2VzdCgnLnRhYnNfX2J0bicpO1xuICAgICAgICAgICAgaWYgKHRhcmdldCkge1xuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgICAgICB0aGlzLnNob3codGFyZ2V0KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfVxufSJdLCJmaWxlIjoidGFicy5qcyJ9
