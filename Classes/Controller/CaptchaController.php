<?php
namespace Inoovum\FormCaptcha\Controller;

/*
 * This file is part of the Inoovum.FormCaptcha package.
 */

use Neos\Flow\Annotations as Flow;
use Inoovum\FormCaptcha\Service\CaptchaService;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\View\JsonView;

class CaptchaController extends ActionController {

    /**
     * @var string string
     */
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @var CaptchaService
     * @Flow\Inject
     */
    protected $captchaService;

    /**
     * @return void
     */
    public function getCaptchaAction()
    {
        $this->view->assign('value', $this->captchaService->createImage());
    }

}
