var formCaptchaElements = document.querySelectorAll('.form-captcha');
if (formCaptchaElements && formCaptchaElements.length > 0) {
    formCaptchaElements.forEach(function (formCaptchaElement) {
        var formCaptchaElementHiddenInput = formCaptchaElement.querySelector('input[type="hidden"]');
        var formCaptchaElementImage = formCaptchaElement.querySelector('img');
        if (formCaptchaElementHiddenInput && formCaptchaElementImage) {
            fetch('/inoovum/form-captcha/get', { method: 'GET', redirect: 'follow' })
                .then(function (response) { return response.json(); })
                .then(function (result) {
                formCaptchaElementHiddenInput.value = result.string;
                formCaptchaElementImage.src = result.image;
            })
                .catch(function (error) { return console.error(error); });
        }
    });
}
