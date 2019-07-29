<?php
/**
 * created by Ekilei <ekilei@gmail.com>
 */
namespace common\widgets;

use Yii;
use yii\helpers\Html;

class Numstepper extends \yii\widgets\InputWidget
{
    public $minusButton = 'minus';
    public $plusButton = 'plus';

    public $min = 'null';
    public $max = 'null';
    public $step = 1;
    public $default = 0;
    public $exclude = [];

    public $append = '{plus}';
    public $prepend = '{minus}';

    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        Html::addCssClass($this->options, 'form-control');
        $addon = false;
        $html = '';

        {
            $input = $this->hasModel()
                ? Html::activeTextInput($this->model, $this->attribute, $this->options)
                : Html::textInput($this->name, $this->value, $this->options);
            $prepend = $this->renderAddon($this->prepend);
            $append = $this->renderAddon($this->append);
            if ($prepend !== '' || $append !== '') {
                $addon = true;
            }
        }

        if ($addon) {
            $html .= Html::beginTag('div', ['class' => 'input-group numstepper']);
            $html .= $prepend;
        }
        $html .= $input;
        if ($addon) {
            $html .= $append;
            $html .= Html::endTag('div');
        }
        $this->registerPlugin();
        return $html;
    }

    protected function renderAddon($addons)
    {
        if ($addons === false) {
            return '';
        }
        if (!is_array($addons)) {
            $addons = [$addons];
        }
        if (!count($addons)) {
            return '';
        }
        $result= '';
        foreach ($addons as $addon) {
            if ($addon === '{plus}') {
                $result .= Html::tag('span', "<span class=\"glyphicon glyphicon-".$this->plusButton."\"></span>", ['class' => 'btn input-group-addon plusbutton']);
            } elseif ($addon === '{minus}') {
                $result .= Html::tag('span', "<span class=\"glyphicon glyphicon-".$this->minusButton."\"></span>", ['class' => 'btn input-group-addon minusbutton']);
            }
        }

        return $result;
    }

    protected function registerPlugin()
    {
        $view = $this->getView();

        $id = $this->options['id'];

        $selector = "jQuery('#$id')";
        $selector .= '.closest(".input-group.numstepper")';

        $js = "$selector.find('.minusbutton').on('click', function() {
            var num = parseFloat($('#$id').val());
            num = num-$this->step;
            ".($this->exclude ? "while(-1 != $.inArray(num,[".implode(',',$this->exclude)."])){
            num = num-$this->step;
            }" : "")."
            if(!num) num = $this->default;
            if($this->min != null && $this->min > num) num = $this->min; 
            if($this->max != null && $this->max < num) num = $this->max; 
            $('#$id').val(num);
        });
        $selector.find('.plusbutton').on('click', function() {
            var num = parseFloat($('#$id').val());
            num = num+$this->step;
            ".($this->exclude ? "while(-1 != $.inArray(num,[".implode(',',$this->exclude)."])){
            num = num+$this->step;
            }" : "")."
            if(!num) num = $this->default;
            if($this->min != null && $this->min > num) num = $this->min; 
            if($this->max != null && $this->max < num) num = $this->max; 
            $('#$id').val(num);
        });
        $('#$id').on('change',function(){
             ".($this->exclude ? "if(0 <= $.inArray(parseFloat($('#$id').val()),[".implode(',',$this->exclude)."])) {
            $('#$id').val('$this->default');
            }" : '')."
        });
        ";

        $js .=  "jQuery('#$id').val(".$this->default.")";
        $view->registerJs($js);

    }



}
