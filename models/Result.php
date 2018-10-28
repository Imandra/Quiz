<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property int $id
 * @property string $test_id
 * @property int $question_id
 * @property int $answer_id
 *
 * @property Answer $answer
 * @property Question $question
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'question_id', 'answer_id'], 'required'],
            [['question_id', 'answer_id'], 'integer'],
            [['test_id'], 'string', 'max' => 255],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'question_id' => 'Question ID',
            'answer_id' => 'Answer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @param string $id
     * @return int
     */
    public static function getNumOfCorrectAnswers($id)
    {
        $results = Result::find()->where('test_id = :id', [':id' => $id])->all();
        $count = 0;
        foreach ($results as $result) {
            if ($result->answer->is_correct) $count++;
        }
        return $count;
    }
}
