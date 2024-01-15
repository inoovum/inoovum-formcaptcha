<?php
namespace Inoovum\FormCaptcha\Validation\Validator;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Cryptography\HashService;

/**
 * @api
 * @Flow\Scope("singleton")
 */
class CaptchaValidator extends \Neos\Flow\Validation\Validator\AbstractValidator
{

    /**
     * @var HashService
     * @Flow\Inject
     */
    protected $hashService;

    /**
     * @var boolean
     */
    protected $acceptsEmptyValues = false;

    /**
     * @param mixed $value The value that should be validated
     * @return void
     * @api
     */
    protected function isValid($value): void
    {
        if (!is_array($value)) {
            $this->addError('This property is required.', 1221560910);
        } else {
            $input = $value['captcha'][1];
            $salt = $value['captcha'][0];
            if(!$this->hashService->validatePassword($input, $salt)) {
                $this->addError('A valid string is expected.', 1238108070);
            }
        }
    }
}
