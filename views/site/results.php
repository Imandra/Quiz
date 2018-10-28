<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var array $results app\models\Result */
/* @var integer $correctAnswers app\models\Result */

$this->title = 'Тест онлайн';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">

            <div class="col-lg-12">

                <h1 style="margin-bottom: 30px">Результаты теста</h1>
                <?php
                foreach ($results as $result) {
                    echo '<p><b>Вопрос: </b>' . $result->question->title . '&nbsp;&nbsp;<b>Ваш ответ: </b>' .
                        $result->answer->title . '&nbsp;&nbsp;';
                    echo ($result->answer->is_correct) ? ' <span style="color: green;">Верно</span>' :
                        ' <span style="color: red;">Не верно</span>' . '</p>';
                }
                ?>
                <hr>
                <p><b>Количество вопросов: </b><?= count($results); ?></p>
                <p><b>Количество правильных ответов: </b><?= $correctAnswers; ?></p>
                <p><b>Тест пройден на </b><?= round($correctAnswers / count($results) * 100); ?> %</p>
                <hr>
                <?= Html::a('Пройти тест снова', ['/site/index'], ['class' => 'btn btn-primary btn-lg']) ?>
            </div>
        </div>

    </div>
</div>


