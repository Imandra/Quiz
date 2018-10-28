<?php

namespace app\models;

use Yii;
use yii\base\DynamicModel;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $title
 *
 * @property Answer[] $answers
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return DynamicModel
     */
    public function getDynamicModel()
    {
        $model = new DynamicModel([
            "answer_$this->id"
        ]);
        $model->addRule(["answer_$this->id"], 'required', ['message' => 'Необходимо выбрать вариант ответа.']);

        return $model;
    }
}
