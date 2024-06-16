document.addEventListener('DOMContentLoaded', function () {

    const email = document.getElementById("inputEmail");

    const validForm = function () {
        if (!email){
            return false;
        }
        email.addEventListener("input", function (event) {
            if (email.validity.typeMismatch) {
                email.style.borderColor = "#FF0000";
                email.previousElementSibling.classList.add('error');
            } else {
                email.style.borderColor = "#0BBC61";
                email.previousElementSibling.classList.remove('error');
            }
        });
    }

    validForm();
})


//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJ2YWxpZGF0aW9uLmpzIl0sInNvdXJjZXNDb250ZW50IjpbImRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCBmdW5jdGlvbiAoKSB7XG5cbiAgICBjb25zdCBlbWFpbCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiaW5wdXRFbWFpbFwiKTtcblxuICAgIGNvbnN0IHZhbGlkRm9ybSA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgZW1haWwuYWRkRXZlbnRMaXN0ZW5lcihcImlucHV0XCIsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgaWYgKGVtYWlsLnZhbGlkaXR5LnR5cGVNaXNtYXRjaCkge1xuICAgICAgICAgICAgICAgIGVtYWlsLnN0eWxlLmJvcmRlckNvbG9yID0gXCIjRkYwMDAwXCI7XG4gICAgICAgICAgICAgICAgZW1haWwucHJldmlvdXNFbGVtZW50U2libGluZy5jbGFzc0xpc3QuYWRkKCdlcnJvcicpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBlbWFpbC5zdHlsZS5ib3JkZXJDb2xvciA9IFwiIzBCQkM2MVwiO1xuICAgICAgICAgICAgICAgIGVtYWlsLnByZXZpb3VzRWxlbWVudFNpYmxpbmcuY2xhc3NMaXN0LnJlbW92ZSgnZXJyb3InKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgdmFsaWRGb3JtKCk7XG59KVxuXG4iXSwiZmlsZSI6InZhbGlkYXRpb24uanMifQ==
