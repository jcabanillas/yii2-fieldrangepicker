<?php
/**
 * @copyright Copyright (c) 2016 jcabanillas
 * @link https://bitevolution.net
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace jcabanillas\fieldrangepicker;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * FieldRangePicker renders a FieldPicker range input.
 *
 * @author Javier Cabanillas <jcabanillas@bitevolution.net>
 * @link https://bitevolution.net/
 * @package jcabanillas\fieldrangepicker
 */
class FieldRangePicker extends InputWidget
{
    /**
     * @var string the attribute name for date range (to Date)
     */
    public $attributeTo;
    /**
     * @var string the name for date range (to Date)
     */
    public $nameTo;
    /**
     * @var string the value for date range (to Date value)
     */
    public $valueTo;
    /**
     * @var array HTML attributes for the date to input
     */
    public $optionsTo;
    /**
     * @var string the label to. Defaults to 'to'.
     */
    public $labelTo = 'to';
    /**
     * @var \yii\widgets\ActiveForm useful for client validation of attributeTo
     */
    public $form;
    /**
     * @var string the template to render. Used internally.
     */
    protected $_template = '{inputFrom}<span class="input-group-addon">{labelTo}</span>{inputTo}';


    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if ((!$this->hasModel() && $this->nameTo === null) || ($this->hasModel() && $this->attributeTo === null)) {
            // @codeCoverageIgnoreStart
            throw new InvalidConfigException("Either 'nameTo', or 'model' and 'attributeTo' properties must be specified.");
            // @codeCoverageIgnoreEnd
        }
        if ($this->size) {
            Html::addCssClass($this->options, 'input-' . $this->size);
            Html::addCssClass($this->optionsTo, 'input-' . $this->size);
            Html::addCssClass($this->containerOptions, 'input-group-' . $this->size);
        }
        Html::addCssClass($this->containerOptions, 'input-group');
        Html::addCssClass($this->options, 'form-control');
        Html::addCssClass($this->optionsTo, 'form-control');
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->form) {
            Html::addCssClass($this->options, 'rangepicker-from');
            Html::addCssClass($this->optionsTo, 'rangepicker-to');
            $inputFrom = $this->form->field(
                $this->model,
                $this->attribute,
                [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'input-group rangepicker-range'],
                ]
            )->textInput($this->options);
            $inputTo = $this->form->field(
                $this->model,
                $this->attributeTo,
                [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'input-group rangepicker-range'],
                ]
            )->textInput($this->optionsTo);
        } else {
            $inputFrom = $this->hasModel()
                ? Html::activeTextInput($this->model, $this->attribute, $this->options)
                : Html::textInput($this->name, $this->value, $this->options);
            $inputTo = $this->hasModel()
                ? Html::activeTextInput($this->model, $this->attributeTo, $this->optionsTo)
                : Html::textInput($this->nameTo, $this->valueTo, $this->optionsTo);
        }
        echo Html::tag(
            'div',
            strtr(
                $this->_template,
                ['{inputFrom}' => $inputFrom, '{labelTo}' => $this->labelTo, '{inputTo}' => $inputTo]
            ), $this->containerOptions);

        $this->registerClientScript();
    }

    /**
     * Registers required script for the plugin to work as DateRangePicker
     */
    public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        FieldRangePickerAsset::register($view);     
    }

}
