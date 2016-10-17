<?php

/**
 * @copyright Copyright (c) 2013-2016 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace jcabanillas\fieldrangepicker;

use yii\web\AssetBundle;

/**
 * DateRangePickerAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\datepicker
 */
class FieldRangePickerAsset extends AssetBundle {

    public $sourcePath = '@vendor/jcabanillas/yii2-fieldrangepicker/src/assets';
    public $css = [
        'css/bootstrap-fieldrangepicker.css'
    ];
    public $depends = [
        'dosamigos\datepicker\DatePickerAsset'
    ];

}
