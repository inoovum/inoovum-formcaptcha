<?php
namespace Inoovum\FormCaptcha\Fusion;

use Neos\Flow\Annotations as Flow;
use Inoovum\FormCaptcha\Service\CaptchaService;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

/**
 * @Flow\Scope("singleton")
 */
class CaptchaFusion extends AbstractFusionObject
{

    /**
     * @Flow\InjectConfiguration(package="Inoovum.FormCaptcha", path="useJs")
     * @var bool
     */
    protected $useJs;

    /**
     * @var CaptchaService
     * @Flow\Inject
     */
    protected $captchaService;

    /**
     * @return array|null
     */
    public function evaluate(): array|null
    {
        if($this->useJs) {
            return null;
        }
        return $this->captchaService->createImage();
    }

}
