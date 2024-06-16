window.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.reg-form').addEventListener('submit', () => {
        document.querySelector('[name="REGISTER[LOGIN]"]').value = document.querySelector('[name="REGISTER[EMAIL]"]').value;
        document.querySelector('[name="REGISTER[CONFIRM_PASSWORD]"]').value = document.querySelector('[name="REGISTER[PASSWORD]"]').value;
    });
});