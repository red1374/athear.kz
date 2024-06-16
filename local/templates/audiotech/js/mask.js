window.addEventListener("DOMContentLoaded", function () {
  [].forEach.call(document.querySelectorAll(".tel"), function (input) {
    var keyCode;
    function mask(event) {
      event.keyCode && (keyCode = event.keyCode);
      var pos = this.selectionStart;
      if (pos < 3) event.preventDefault();
      var matrix = "+7 (___) ___ ____",
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = this.value.replace(/\D/g, ""),
        new_value = matrix.replace(/[_\d]/g, function (a) {
          return i < val.length ? val.charAt(i++) : a;
        });
      i = new_value.indexOf("_");
      if (i != -1) {
        i < 5 && (i = 3);
        new_value = new_value.slice(0, i);
      }
      var reg = matrix
        .substr(0, this.value.length)
        .replace(/_+/g, function (a) {
          return "\\d{1," + a.length + "}";
        })
        .replace(/[+()]/g, "\\$&");
      reg = new RegExp("^" + reg + "$");
      if (
        !reg.test(this.value) ||
        this.value.length < 5 ||
        (keyCode > 47 && keyCode < 58)
      ) {
        this.value = new_value;
      }
      if (event.type == "blur" && this.value.length < 5) {
        this.value = "";
      }
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false);
  });
});

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJtYXNrLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIndpbmRvdy5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCBmdW5jdGlvbiAoKSB7XG4gIFtdLmZvckVhY2guY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFwiLnRlbFwiKSwgZnVuY3Rpb24gKGlucHV0KSB7XG4gICAgdmFyIGtleUNvZGU7XG4gICAgZnVuY3Rpb24gbWFzayhldmVudCkge1xuICAgICAgZXZlbnQua2V5Q29kZSAmJiAoa2V5Q29kZSA9IGV2ZW50LmtleUNvZGUpO1xuICAgICAgdmFyIHBvcyA9IHRoaXMuc2VsZWN0aW9uU3RhcnQ7XG4gICAgICBpZiAocG9zIDwgMykgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgIHZhciBtYXRyaXggPSBcIis3IChfX18pIF9fXyBfX19fXCIsXG4gICAgICAgIGkgPSAwLFxuICAgICAgICBkZWYgPSBtYXRyaXgucmVwbGFjZSgvXFxEL2csIFwiXCIpLFxuICAgICAgICB2YWwgPSB0aGlzLnZhbHVlLnJlcGxhY2UoL1xcRC9nLCBcIlwiKSxcbiAgICAgICAgbmV3X3ZhbHVlID0gbWF0cml4LnJlcGxhY2UoL1tfXFxkXS9nLCBmdW5jdGlvbiAoYSkge1xuICAgICAgICAgIHJldHVybiBpIDwgdmFsLmxlbmd0aCA/IHZhbC5jaGFyQXQoaSsrKSA6IGE7XG4gICAgICAgIH0pO1xuICAgICAgaSA9IG5ld192YWx1ZS5pbmRleE9mKFwiX1wiKTtcbiAgICAgIGlmIChpICE9IC0xKSB7XG4gICAgICAgIGkgPCA1ICYmIChpID0gMyk7XG4gICAgICAgIG5ld192YWx1ZSA9IG5ld192YWx1ZS5zbGljZSgwLCBpKTtcbiAgICAgIH1cbiAgICAgIHZhciByZWcgPSBtYXRyaXhcbiAgICAgICAgLnN1YnN0cigwLCB0aGlzLnZhbHVlLmxlbmd0aClcbiAgICAgICAgLnJlcGxhY2UoL18rL2csIGZ1bmN0aW9uIChhKSB7XG4gICAgICAgICAgcmV0dXJuIFwiXFxcXGR7MSxcIiArIGEubGVuZ3RoICsgXCJ9XCI7XG4gICAgICAgIH0pXG4gICAgICAgIC5yZXBsYWNlKC9bKygpXS9nLCBcIlxcXFwkJlwiKTtcbiAgICAgIHJlZyA9IG5ldyBSZWdFeHAoXCJeXCIgKyByZWcgKyBcIiRcIik7XG4gICAgICBpZiAoXG4gICAgICAgICFyZWcudGVzdCh0aGlzLnZhbHVlKSB8fFxuICAgICAgICB0aGlzLnZhbHVlLmxlbmd0aCA8IDUgfHxcbiAgICAgICAgKGtleUNvZGUgPiA0NyAmJiBrZXlDb2RlIDwgNTgpXG4gICAgICApIHtcbiAgICAgICAgdGhpcy52YWx1ZSA9IG5ld192YWx1ZTtcbiAgICAgIH1cbiAgICAgIGlmIChldmVudC50eXBlID09IFwiYmx1clwiICYmIHRoaXMudmFsdWUubGVuZ3RoIDwgNSkge1xuICAgICAgICB0aGlzLnZhbHVlID0gXCJcIjtcbiAgICAgIH1cbiAgICB9XG5cbiAgICBpbnB1dC5hZGRFdmVudExpc3RlbmVyKFwiaW5wdXRcIiwgbWFzaywgZmFsc2UpO1xuICAgIGlucHV0LmFkZEV2ZW50TGlzdGVuZXIoXCJmb2N1c1wiLCBtYXNrLCBmYWxzZSk7XG4gICAgaW5wdXQuYWRkRXZlbnRMaXN0ZW5lcihcImJsdXJcIiwgbWFzaywgZmFsc2UpO1xuICAgIGlucHV0LmFkZEV2ZW50TGlzdGVuZXIoXCJrZXlkb3duXCIsIG1hc2ssIGZhbHNlKTtcbiAgfSk7XG59KTtcbiJdLCJmaWxlIjoibWFzay5qcyJ9
