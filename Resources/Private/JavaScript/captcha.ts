interface FormCaptchaData {
    image: string;
    string: string;
}

const formCaptchaElements = document.querySelectorAll('.form-captcha');

if(formCaptchaElements && formCaptchaElements.length > 0) {
    formCaptchaElements.forEach((formCaptchaElement: HTMLDivElement)=> {

        const formCaptchaElementHiddenInput = formCaptchaElement.querySelector('input[type="hidden"]') as HTMLInputElement;
        const formCaptchaElementImage = formCaptchaElement.querySelector('img') as HTMLImageElement;

        if(formCaptchaElementHiddenInput && formCaptchaElementImage) {
            fetch('/inoovum/form-captcha/get', {method: 'GET', redirect: 'follow'})
                .then((response) => response.json())
                .then((result: FormCaptchaData) => {
                    formCaptchaElementHiddenInput.value = result.string;
                    formCaptchaElementImage.src = result.image;
                })
                .catch((error) => console.error(error));
        }
    });
}
