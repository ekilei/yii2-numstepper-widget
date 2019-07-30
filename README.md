# yii2-numstepper-widget

Numstepper является надстройкой над InputWidget, предназначен для адаптивных сайтов, удобен в применении на декстопе и на мобильных устройствах.

Numstepper is an add-on above the InputWidget, designed for adaptive sites, convenient for use on the desktop and on mobile devices.


```angular2html
<?= $form->field($model,'day')->widget(\common\widgets\Numstepper::className()) ?>
?>
```

### C параметрами
With parameters

![ScreenShot](https://raw.github.com/ekilei/yii2-numstepper-widget/master/screen/1.png)

```angular2html
<?= $form->field($model,'day')->widget(\common\widgets\Numstepper::className(),
    [
        'min' => -28,
        'max' => 28,
    ])
?>
```

### C исключением и значением при инициализации
With exception and initialization value
```angular2html
<?= $form->field($model,'day')->widget(\common\widgets\Numstepper::className(),
    [
        'min' => -28,
        'max' => 28,
        'exclude' => [0],
        'default' => (int)$model->day ? (int)$model->day : 1,
    ])
?>
```

### C подсказкой
With a hint

![ScreenShot](https://raw.github.com/ekilei/yii2-numstepper-widget/master/screen/2.png)

```angular2html
<?= $form->field($model,'day')->widget(\common\widgets\Numstepper::className(),
[
    'min' => -28,
    'max' => 28,
    'exclude' => [0],
    'default' => (int)$model->day ? (int)$model->day : 1,
    ])
     ->hint(Yii::t('app','Negative numbers make it possible to choose a day from the end of the month.').'
            <br>'.Yii::t('app','Example').': "-1" = [31,30,28(29)], а "-3" = [29,28,26(27)] ') 
?>
```

### Со своими иконками кнопок
With own icon buttons

![ScreenShot](https://raw.github.com/ekilei/yii2-numstepper-widget/master/screen/3.png)

```angular2html
<?= $form->field($model,'day')->widget(\common\widgets\Numstepper::className(),
    [
        'default' => (int)$model->day ? (int)$model->day : 1,
        'minusButton' => 'menu-down',
        'plusButton' => 'menu-up',
    ])
?>
```

### С изменением расположением кнопок      
With the change in the arrangement of the buttons
     
![ScreenShot](https://raw.github.com/ekilei/yii2-numstepper-widget/master/screen/4.png)
              
```angular2html
<?= $form->field($model,'day')->widget(\common\widgets\Numstepper::className(),
    [
        'default' => (int)$model->day ? (int)$model->day : 1,
        'minusButton' => 'menu-down',
        'plusButton' => 'menu-up',
        'prepend' => [],
        'append' => ['{minus}','{plus}'],
    ])
?>
```

### Установка
Install

```
composer require ekilei/yii2-numstepper-widget "dev-master"
```