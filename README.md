# Form captcha

Captcha form field to protect recipients from spam.


## Installation

The Inoovum.FormCaptcha package is listed on packagist (https://packagist.org/packages/inoovum/formcaptcha) - therefore you don't have to include the package in your "repositories" entry any more.

Just run:

```
composer require inoovum/formcaptcha
```

## Usage

Use the form element "Captcha" and the validator "Captcha validator". Please note that you have to exclude the form element Captcha in the template of the email finisher.

### Override email template

```
prototype(Neos.Form.Builder:EmailFinisher.Definition) {
    options {
        templatePathAndFilename = 'resource://Inoovum.FormCaptcha/Private/Templates/Form/Email.html'
    }
}
```

### Usage in your own email template

```
<f:if condition="{0: formValue.element.type} == {0: 'Inoovum.FormCaptcha:Captcha'}">
    <f:else>
        <th style="text-align:left;">{f:if(condition: formValue.element.label, then: formValue.element.label, else: formValue.element.identifier)}</th>
        <td>{formValue.value}</td>
    </f:else>
</f:if>
```

## Author

* E-Mail: patric.eckhart@steinbauer-it.com
* URL: http://www.steinbauer-it.com
