<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $questions app\models\Question */

$this->title = 'Тест онлайн';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <div class="col-lg-12">

                <h1 style="margin-bottom: 30px">Пройдите тест</h1>
                <?php $form = ActiveForm::begin(['action' => '/site/test']); ?>
                <?php foreach ($questions as $question) {
                    echo '<h4 style="margin-bottom: 15px">' . Html::encode($question->title) . '</h4>';
                    echo $form->field($question->dynamicModel, "answer_$question->id")->radioList(
                        ArrayHelper::map($question->answers, 'id', 'title'),
                        ['name' => "Answer[$question->id]", 'id' => "Answer_$question->id",]
                    )->label('Варианты ответов:');
                    echo '<hr>';
                } ?>
                <input type="hidden" name="test_id" value="<?= uniqid(); ?>">
                <div class="form-group">
                    <?= Html::submitButton('Проверить ответы', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
