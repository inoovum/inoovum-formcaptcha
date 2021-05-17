<?php
namespace Inoovum\FormCaptcha\Validation\Validator;

use Neos\Flow\Annotations as Flow;

/**
 * @api
 * @Flow\Scope("singleton")
 */
class CaptchaValidator extends \Neos\Flow\Validation\Validator\AbstractValidator
{
    /**
     * @var boolean
     */
    protected $acceptsEmptyValues = false;

    /**
     * @param mixed $value The value that should be validated
     * @return void
     * @api
     */
    protected function isValid($value)
    {
        if (!is_array($value)) {
            $this->addError('This property is required.', 1221560910);
        } else {
            $base64 = base64_decode($value['captcha'][0]);
            $input = $value['captcha'][1];
            if($base64 != $input) {
                $this->addError('A valid string is expected.', 1238108070);
            }
        }
    }
}
