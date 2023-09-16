<?php

namespace Academy01\SimpleCaptcha;

class Captcha {

    private static $path = __DIR__;
    private static $dimentions = [200, 100];

    public function __construct()
    {
        // start session here
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    public static function generate() {

        // captcha text
        $value = rand(1000, 99999);

        // generate random coordinates for text position
        $textX = rand(20, self::$dimentions[0] - 50); 
        $textY = rand(40, self::$dimentions[1] - 20); 



        $_SESSION['A01_captcha_value'] = $value;

        $captcha = imagecreatefromjpeg(self::$path."/../assets/images/captcha-".rand(1,6).".jpg");

        $color = imagecolorallocate($captcha, rand(0, 150), rand(0, 150), rand(0, 255));

        $font = self::$path."/../assets/fonts/code.otf";

        imagettftext($captcha, rand(15, 30), rand(0, 45), $textX, $textY, $color, $font, $value);

        ob_start();
        imagepng($captcha);
        $imageData = ob_get_clean();
        imagedestroy($captcha);

        return 'data:image/png;base64,' . base64_encode($imageData);

    }

    public static function validate($input_captcha) {

        $input_captcha = filter_var($input_captcha, FILTER_SANITIZE_ENCODED);
        $input_captcha = htmlspecialchars($input_captcha);

        if(!isset($_SESSION['A01_captcha_value'])) {
            return false;
        }

        $captcha = htmlspecialchars($_SESSION['A01_captcha_value']);

        if($captcha === $input_captcha) {
            $_SESSION['A01_captcha_value'] = NULL;
            unset($_SESSION['A01_captcha_value']);

            return true;
        }else{
            return false;
        }

    }

}