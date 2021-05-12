<?php
namespace Inoovum\FormCaptcha\Fusion;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

/**
 * @Flow\Scope("singleton")
 */
class CaptchaFusion extends AbstractFusionObject {

    /**
     * @return array
     */
    public function evaluate():array
    {
        $captcha = $this->createImage();
        return $captcha;
    }

    /**
     * @param string $input
     * @param integer $strength
     * @param bool $secure
     *
     * @return string
     * @throws
     */
    public function secureGenerateString(string $input, int $strength = 5, bool $secure = true):string
    {
        $inputLength = strlen($input);
        $randomString = '';
        for($i = 0; $i < $strength; $i++) {
            if($secure) {
                $randomCharacter = $input[random_int(0, $inputLength - 1)];
            } else {
                $randomCharacter = $input[mt_rand(0, $inputLength - 1)];
            }
            $randomString .= $randomCharacter;
        }
        return $randomString;
    }

    /**
     * @return array
     * @throws
     */
    public function createImage():array
    {
        $image = imagecreatetruecolor(200, 50);
        imageantialias($image, true);
        $colors = [];
        $red = rand(125, 175);
        $green = rand(125, 175);
        $blue = rand(125, 175);
        for($i = 0; $i < 5; $i++) {
            $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
        }
        imagefill($image, 0, 0, $colors[0]);
        for($i = 0; $i < 10; $i++) {
            imagesetthickness($image, rand(2, 10));
            $rect_color = $colors[rand(1, 4)];
            imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
        }

        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $textcolors = [$black, $white];

        $fontDirectory = constant('FLOW_PATH_ROOT') . 'Packages/Application/Inoovum.FormCaptcha/Resources/Private/Fonts/';
        $fonts = [$fontDirectory . 'Acme.ttf', $fontDirectory . 'Ubuntu.ttf', $fontDirectory . 'Merriweather.ttf', $fontDirectory . 'PlayfairDisplay.ttf'];

        $permittedChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringLength = 6;
        $captchaString = $this->secureGenerateString($permittedChars, $stringLength);

        for($i = 0; $i < $stringLength; $i++) {
            $letterSpace = 170/$stringLength;
            $initial = 15;
            imagettftext($image, 20, rand(-15, 15), $initial + $i * $letterSpace, rand(20, 40), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captchaString[$i]);
        }

        ob_start();
        imagepng($image);
        imagedestroy($image);
        $bin = ob_get_clean();
        $b64 = 'data:image/image/png;base64,' . base64_encode($bin);

        $captchaImage = [
            'image' => $b64,
            'string' => base64_encode($captchaString)
        ];

        return $captchaImage;

    }

}
