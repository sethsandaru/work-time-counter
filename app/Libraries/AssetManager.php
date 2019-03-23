<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 3/23/2019
 * Time: 10:55 AM
 */

namespace App\Libraries;


class AssetManager
{
    static $js = [];
    static $css = [];

    private function __construct() {} // prevent create

    public static function addJs($path) {
        static::$js[] = $path;
    }

    public static function addCss($path) {
        static::$css[] = $path;
    }

    public static function init() {
        // css
        static::addCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
        static::addCss(asset('css/bootstrap-datepicker.css'));

        // js
        static::addJs('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
        static::addJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
        static::addJs('https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
        static::addJs(asset('js/underscore.js'));
        static::addJs(asset('js/bootstrap-datepicker.min.js'));
        static::addJs(asset('js/jquery.noty.js'));
        static::addJs(asset('js/toaster.js'));
        static::addJs(asset('js/ajax_service.js'));
    }
}