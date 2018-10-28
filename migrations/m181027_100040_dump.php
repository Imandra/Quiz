<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m181027_100040_dump
 */
class m181027_100040_dump extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%question}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%answer}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'is_correct' => Schema::TYPE_BOOLEAN,
            'question_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_answer_question_id', '{{%answer}}', 'question_id',
            '{{%question}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_answer_question_id', '{{%answer}}');
        $this->dropTable('{{%answer}}');
        $this->dropTable('{{%question}}');
    }
}
